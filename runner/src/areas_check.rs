//! Keeping the runtime side in step with the real runtime: the native areas `worker.rs` boots, and how it builds and
//! wires them, that the runner doesn't.
//!
//! The worker's areas are its area list (`let mut areas: Vec<Rc<dyn NativeArea>> = vec![…]`), then each
//! `areas.push(Rc::new(…))`, and each `areas.extend(x)` where `x` came from a function in the worker's modules that
//! builds an area list of its own (`boot_database` in `database.rs`). Only the worker's text up to `Php::boot(` is
//! read: that is where the areas are fixed.
//!
//! For each area type, the runner must name the type, make the same builder calls on it
//! (`let a = Type::new(…).x(…).y(…)`), and make the same wiring calls: `Type::f(…)` (other than `new`), and
//! `v.f(…)` on a variable `v` of that type, such as `area.bind_defaults()` or `media.ports(…)`.
//!
//! Every text is read with comments removed, and names are matched as whole identifiers. Anything this check can't
//! read is reported, never skipped.

use std::collections::BTreeSet;

/// The marker that starts an area list.
const LIST: &str = "areas: Vec<Rc<dyn NativeArea>> = vec![";

/// What the worker boots that the runner doesn't, sorted: an area type (`OptionsArea`), a builder or wiring call
/// (`ContainerArea.bindings`, `PasswordArea.bind_defaults`), or something it can't read.
///
/// `worker_rs` is `worker.rs`; `worker_modules` the worker's other source files (`database.rs`, `wake.rs`);
/// `runner_sources` the runner's files that boot the runtime side (`sides.rs` and its copies).
pub fn missing_areas(
    worker_rs: &str,
    worker_modules: &[&str],
    runner_sources: &[&str],
) -> Vec<String> {
    let worker_full = strip_comments(worker_rs);
    let worker = match worker_full.find("Php::boot(") {
        Some(at) => worker_full[..at].to_string(),
        None => worker_full,
    };
    let modules: Vec<String> = worker_modules.iter().map(|m| strip_comments(m)).collect();
    let mut worker_files: Vec<&str> = vec![&worker];
    worker_files.extend(modules.iter().map(String::as_str));
    let runner: Vec<String> = runner_sources.iter().map(|s| strip_comments(s)).collect();
    let runner_files: Vec<&str> = runner.iter().map(String::as_str).collect();

    let mut problems = Vec::new();
    let types = worker_areas(&worker, &worker_files, &mut problems);

    for ty in &types {
        if !runner_files.iter().any(|f| has_identifier(f, ty)) {
            problems.push(ty.clone());
            continue;
        }
        if let Some(theirs) = worker_files.iter().find_map(|f| builder_calls(f, ty)) {
            let ours = runner_files
                .iter()
                .find_map(|f| builder_calls(f, ty))
                .unwrap_or_default();
            for call in theirs {
                if !ours.contains(&call) {
                    problems.push(format!("{ty}.{call}"));
                }
            }
        }
        let ours = wiring_calls(&runner_files, ty);
        for call in wiring_calls(&worker_files, ty) {
            if !ours.contains(&call) {
                problems.push(format!("{ty}.{call}"));
            }
        }
    }
    problems.sort();
    problems.dedup();
    problems
}

/// The area types the worker boots, in order: its list, then what it pushes and extends.
fn worker_areas(worker: &str, files: &[&str], problems: &mut Vec<String>) -> Vec<String> {
    let Some((list, after)) = area_list(worker) else {
        problems.push(format!("no `{LIST}` in worker.rs"));
        return Vec::new();
    };
    let Some(list) = list else {
        problems.push("the worker's area list never closes".to_string());
        return Vec::new();
    };
    let mut types = entry_types(worker, files, list, problems);

    let mut search = after;
    while let Some(found) = worker[search..].find("areas.") {
        let at = search + found;
        search = at + "areas.".len();
        if !is_boundary(worker, at) {
            continue;
        }
        let rest = &worker[search..];
        let method = identifier(rest);
        let Some(open) = rest[method.len()..].strip_prefix('(') else {
            problems.push(format!("unrecognised use of the area list: areas.{method}"));
            continue;
        };
        let Some(close) = close_of(open, '(', ')') else {
            problems.push(format!(
                "unrecognised use of the area list: areas.{method}("
            ));
            continue;
        };
        let arg = open[..close].trim();
        match method {
            "push" => types.extend(entry_types(worker, files, arg, problems)),
            "extend" => types.extend(extended_types(worker, at, files, arg, problems)),
            _ => problems.push(format!(
                "unrecognised use of the area list: areas.{method}({arg})"
            )),
        }
    }
    types
}

/// The area list in `text`: its contents (None when it never closes), and the index just past it.
fn area_list(text: &str) -> Option<(Option<&str>, usize)> {
    let from = text.find(LIST)? + LIST.len();
    let body = &text[from..];
    Some(match close_of(body, '[', ']') {
        Some(end) => (Some(&body[..end]), from + end + 1),
        None => (None, text.len()),
    })
}

/// The area types of a list's entries (or of one `push` argument), resolved in `text`.
fn entry_types(text: &str, files: &[&str], list: &str, problems: &mut Vec<String>) -> Vec<String> {
    let mut types = Vec::new();
    for entry in split_top_level(list) {
        match area_type(text, files, entry) {
            Some(ty) => types.push(ty),
            None => problems.push(format!("unrecognised area entry: {entry}")),
        }
    }
    types
}

/// `areas.extend(x)` at `at`: `x` must come from the nearest earlier call of a function, in the worker's files, that
/// builds an area list of its own and adds nothing after it.
fn extended_types(
    worker: &str,
    at: usize,
    files: &[&str],
    arg: &str,
    problems: &mut Vec<String>,
) -> Vec<String> {
    let unreadable = |problems: &mut Vec<String>| {
        problems.push(format!("unrecognised area extension: areas.extend({arg})"));
        Vec::new()
    };
    if identifier(arg) != arg || arg.is_empty() {
        return unreadable(problems);
    }
    let before = &worker[..at];
    // (call position, function body)
    let mut best: Option<(usize, &str)> = None;
    for file in files {
        for (name, body) in functions(file) {
            if !body.contains(LIST) {
                continue;
            }
            if let Some(call) = last_call(before, name)
                && best.is_none_or(|(pos, _)| call > pos)
            {
                best = Some((call, body));
            }
        }
    }
    let Some((call, body)) = best else {
        return unreadable(problems);
    };
    // The value must be bound between the call and the extension.
    if !has_identifier(&before[call..], arg) {
        return unreadable(problems);
    }
    let Some((Some(list), after)) = area_list(body) else {
        return unreadable(problems);
    };
    let tail = &body[after..];
    let mut search = 0;
    while let Some(found) = tail[search..].find("areas.") {
        let pos = search + found;
        if is_boundary(tail, pos) {
            return unreadable(problems);
        }
        search = pos + 1;
    }
    entry_types(body, files, list, problems)
}

/// Every `fn name(…) … { body }` in `text`, with its body.
fn functions(text: &str) -> Vec<(&str, &str)> {
    let mut out = Vec::new();
    let mut search = 0;
    while let Some(found) = text[search..].find("fn ") {
        let at = search + found;
        search = at + 3;
        if !is_boundary(text, at) {
            continue;
        }
        let name = identifier(&text[at + 3..]);
        if name.is_empty() {
            continue;
        }
        let Some(open) = text[at..].find('{') else {
            continue;
        };
        let start = at + open + 1;
        if let Some(close) = close_of(&text[start..], '{', '}') {
            out.push((name, &text[start..start + close]));
        }
    }
    out
}

/// The position of the last call `name(` in `text` (a whole identifier, not a definition).
fn last_call(text: &str, name: &str) -> Option<usize> {
    let needle = format!("{name}(");
    let mut last = None;
    let mut search = 0;
    while let Some(found) = text[search..].find(&needle) {
        let at = search + found;
        if is_boundary(text, at) && !text[..at].trim_end().ends_with("fn") {
            last = Some(at);
        }
        search = at + needle.len();
    }
    last
}

/// The area type an entry names: `Rc::new(Type(…))`, `Rc::new(path::Type(…))`, `Rc::new(Type::new(…))`,
/// `Rc::new(var)` with `var` bound to one of those or to a call of a function returning the type, or
/// `…::twins_area()`.
fn area_type(text: &str, files: &[&str], entry: &str) -> Option<String> {
    if entry == "twins_area()" || entry.ends_with("::twins_area()") {
        return Some("twins_area".to_string());
    }
    let inner = entry.strip_prefix("Rc::new(")?.strip_suffix(')')?;
    expr_type(text, files, inner, 0)
}

/// The type an expression makes: a tuple-struct or `Type::f(…)` call, a call of a function returning a plain type,
/// or a variable bound to one of those.
fn expr_type(text: &str, files: &[&str], expr: &str, depth: u8) -> Option<String> {
    if depth > 4 {
        return None;
    }
    let expr = expr.trim();
    let (segments, after) = path(expr);
    let last = *segments.last()?;
    if after.starts_with('(') || after.starts_with("::<") {
        if starts_upper(last) {
            return Some(last.to_string());
        }
        if segments.len() >= 2 && starts_upper(segments[segments.len() - 2]) {
            return Some(segments[segments.len() - 2].to_string());
        }
        return files.iter().find_map(|f| return_type(f, last));
    }
    if after.is_empty() && segments.len() == 1 {
        let pattern = format!("let {last} = ");
        let mut search = 0;
        while let Some(found) = text[search..].find(&pattern) {
            let at = search + found + pattern.len();
            search = at;
            if let Some(ty) = expr_type(text, files, &text[at..], depth + 1) {
                return Some(ty);
            }
        }
    }
    None
}

/// The path at the start of `text` (`a::b::C`), and what follows it.
fn path(text: &str) -> (Vec<&str>, &str) {
    let mut segments = Vec::new();
    let mut rest = text;
    loop {
        let name = identifier(rest);
        if name.is_empty() {
            break;
        }
        segments.push(name);
        rest = &rest[name.len()..];
        match rest.strip_prefix("::") {
            Some(tail) if !tail.starts_with('<') => rest = tail,
            _ => break,
        }
    }
    (segments, rest)
}

/// The plain type `fn name(…) -> Type` returns in `text`.
fn return_type(text: &str, name: &str) -> Option<String> {
    let needle = format!("fn {name}(");
    let at = text.find(&needle)?;
    let args = &text[at + needle.len()..];
    let close = close_of(args, '(', ')')?;
    let ret = args[close + 1..]
        .trim_start()
        .strip_prefix("->")?
        .trim_start();
    let ty = identifier(ret);
    let plain = ret[ty.len()..].trim_start().starts_with('{');
    (starts_upper(ty) && plain).then(|| ty.to_string())
}

/// The wiring calls on `ty` across `files`: `Type::f(` other than `new`, and `v.f(` on each variable `v` bound to
/// the type, inside the block that binds it.
fn wiring_calls(files: &[&str], ty: &str) -> BTreeSet<String> {
    let mut calls = BTreeSet::new();
    for text in files {
        let needle = format!("{ty}::");
        let mut search = 0;
        while let Some(found) = text[search..].find(&needle) {
            let at = search + found;
            search = at + needle.len();
            if !is_boundary(text, at) {
                continue;
            }
            let name = identifier(&text[search..]);
            let tail = &text[search + name.len()..];
            if !name.is_empty()
                && name != "new"
                && (tail.starts_with('(') || tail.starts_with("::<"))
            {
                calls.insert(name.to_string());
            }
        }
        let mut search = 0;
        while let Some(found) = text[search..].find("let ") {
            let at = search + found;
            search = at + 4;
            if !is_boundary(text, at) {
                continue;
            }
            let mut rest = &text[search..];
            if let Some(tail) = rest.strip_prefix("mut ") {
                rest = tail;
            }
            let var = identifier(rest);
            let Some(value) = rest[var.len()..].strip_prefix(" = ") else {
                continue;
            };
            if var.is_empty() || expr_type(text, files, value, 1).as_deref() != Some(ty) {
                continue;
            }
            let block = &text[at..];
            let block = close_of(block, '{', '}').map_or(block, |end| &block[..end]);
            let member = format!("{var}.");
            let mut inner = 0;
            while let Some(found) = block[inner..].find(&member) {
                let pos = inner + found;
                inner = pos + member.len();
                if !is_boundary(block, pos) {
                    continue;
                }
                let name = identifier(&block[inner..]);
                if !name.is_empty() && block[inner + name.len()..].starts_with('(') {
                    calls.insert(name.to_string());
                }
            }
        }
    }
    calls
}

/// The method names called on `let … = Type::new(…)` up to its `;`, in order.
fn builder_calls(text: &str, ty: &str) -> Option<Vec<String>> {
    let needle = format!("{ty}::new(");
    let mut search = 0;
    let at = loop {
        let found = search + text[search..].find(&needle)?;
        if is_boundary(text, found) && text[..found].trim_end().ends_with('=') {
            break found;
        }
        search = found + needle.len();
    };
    let args = &text[at + needle.len()..];
    let close = close_of(args, '(', ')')?;
    let mut rest = &args[close + 1..];
    let mut calls = Vec::new();
    loop {
        let trimmed = rest.trim_start();
        let Some(after_dot) = trimmed.strip_prefix('.') else {
            break;
        };
        let name = identifier(after_dot);
        if name.is_empty() {
            break;
        }
        calls.push(name.to_string());
        let mut tail = &after_dot[name.len()..];
        if tail.starts_with("::<") {
            let close = close_of(&tail[3..], '<', '>')?;
            tail = &tail[3 + close + 1..];
        }
        let Some(open) = tail.strip_prefix('(') else {
            break;
        };
        let close = close_of(open, '(', ')')?;
        rest = &open[close + 1..];
    }
    Some(calls)
}

/// The index of the bracket closing the one already opened before `text`.
fn close_of(text: &str, open: char, close: char) -> Option<usize> {
    let mut depth = 0usize;
    for (i, c) in text.char_indices() {
        if c == open {
            depth += 1;
        } else if c == close {
            if depth == 0 {
                return Some(i);
            }
            depth -= 1;
        }
    }
    None
}

/// The list's entries, split at commas outside brackets, trimmed, empty ones dropped.
fn split_top_level(list: &str) -> Vec<&str> {
    let mut out = Vec::new();
    let (mut depth, mut start) = (0i32, 0usize);
    for (i, c) in list.char_indices() {
        match c {
            '(' | '[' | '{' | '<' => depth += 1,
            ')' | ']' | '}' | '>' => depth -= 1,
            ',' if depth == 0 => {
                out.push(list[start..i].trim());
                start = i + 1;
            }
            _ => {}
        }
    }
    out.push(list[start..].trim());
    out.into_iter().filter(|e| !e.is_empty()).collect()
}

fn has_identifier(text: &str, name: &str) -> bool {
    let mut search = 0;
    while let Some(found) = text[search..].find(name) {
        let at = search + found;
        let end = at + name.len();
        let after_ok = text[end..]
            .chars()
            .next()
            .is_none_or(|c| !(c.is_alphanumeric() || c == '_'));
        if is_boundary(text, at) && after_ok {
            return true;
        }
        search = end;
    }
    false
}

/// Whether `at` starts an identifier or path of its own: not inside a longer name, and not a field or method of
/// something else (`x.areas`).
fn is_boundary(text: &str, at: usize) -> bool {
    text[..at]
        .chars()
        .next_back()
        .is_none_or(|c| !(c.is_alphanumeric() || c == '_' || c == '.'))
}

fn starts_upper(name: &str) -> bool {
    name.chars().next().is_some_and(|c| c.is_ascii_uppercase())
}

fn identifier(text: &str) -> &str {
    let end = text
        .find(|c: char| !(c.is_alphanumeric() || c == '_'))
        .unwrap_or(text.len());
    &text[..end]
}

/// The text with `// …` and `/* … */` comments removed (string literals are not special-cased: area code has none
/// that contain comment markers).
fn strip_comments(text: &str) -> String {
    let mut out = String::with_capacity(text.len());
    let mut rest = text;
    while !rest.is_empty() {
        if let Some(tail) = rest.strip_prefix("//") {
            rest = tail.find('\n').map_or("", |n| &tail[n..]);
        } else if let Some(tail) = rest.strip_prefix("/*") {
            rest = tail.find("*/").map_or("", |n| &tail[n + 2..]);
        } else {
            let c = rest.chars().next().unwrap();
            out.push(c);
            rest = &rest[c.len_utf8()..];
        }
    }
    out
}
