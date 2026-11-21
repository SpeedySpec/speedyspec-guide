//! Keeping the runtime side in step with the real runtime: the native areas `worker.rs` boots, and the builder calls it
//! makes on them, that `sides.rs` doesn't.
//!
//! Both texts are read with comments removed, and names are matched as whole identifiers. Anything in the worker's
//! area list this check can't read is reported, never skipped.

/// What `worker_rs` boots that `sides_rs` doesn't, sorted: an area type (`OptionsArea`), a builder call
/// (`ContainerArea.bindings`), an entry it can't read, or areas added after the list.
pub fn missing_areas(worker_rs: &str, sides_rs: &str) -> Vec<String> {
    let worker = strip_comments(worker_rs);
    let sides = strip_comments(sides_rs);
    let start = "let areas: Vec<Rc<dyn NativeArea>> = vec![";
    let Some(from) = worker.find(start) else {
        return vec![format!("no `{start}` in worker.rs")];
    };
    let body = &worker[from + start.len()..];
    let Some(end) = close_of(body, '[', ']') else {
        return vec!["the worker's area list never closes".to_string()];
    };
    let list = &body[..end];

    let mut problems = Vec::new();
    for marker in ["areas.push(", "areas.extend("] {
        if worker.contains(marker) {
            problems.push(format!(
                "the worker adds areas after the list ({})",
                &marker[..marker.len() - 1]
            ));
        }
    }

    let mut types = Vec::new();
    for entry in split_top_level(list) {
        match area_type(&worker, entry) {
            Some(ty) => types.push(ty),
            None => problems.push(format!("unrecognised area entry: {entry}")),
        }
    }
    for ty in &types {
        if !has_identifier(&sides, ty) {
            problems.push(ty.clone());
            continue;
        }
        if let Some(theirs) = builder_calls(&worker, ty) {
            let ours = builder_calls(&sides, ty).unwrap_or_default();
            for call in theirs {
                if !ours.contains(&call) {
                    problems.push(format!("{ty}.{call}"));
                }
            }
        }
    }
    problems.sort();
    problems.dedup();
    problems
}

/// The area type an entry names: `Rc::new(Type(…))`, `Rc::new(Type::new(…))`, `Rc::new(var)` with
/// `let var = Type::new…`, or `…::twins_area()`.
fn area_type(text: &str, entry: &str) -> Option<String> {
    if entry == "twins_area()" || entry.ends_with("::twins_area()") {
        return Some("twins_area".to_string());
    }
    let inner = entry.strip_prefix("Rc::new(")?.strip_suffix(')')?;
    let ident = identifier(inner);
    if ident.is_empty() {
        return None;
    }
    let after = &inner[ident.len()..];
    if after.starts_with('(') || after.starts_with("::") {
        return Some(ident.to_string());
    }
    if after.is_empty() {
        let pattern = format!("let {ident} = ");
        let at = text.find(&pattern)?;
        let ty = identifier(&text[at + pattern.len()..]);
        return (!ty.is_empty()).then(|| ty.to_string());
    }
    None
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

fn is_boundary(text: &str, at: usize) -> bool {
    text[..at]
        .chars()
        .next_back()
        .is_none_or(|c| !(c.is_alphanumeric() || c == '_'))
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
