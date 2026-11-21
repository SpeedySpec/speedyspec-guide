//! Keeping the runtime side in step with the real runtime: which native areas `worker.rs` boots that `sides.rs`
//! doesn't.

/// `RequestHooksArea` is private to the runtime binary; the runner gives `BootOptions.hooks` a `MemoryHooks` instead.
const NOT_NEEDED: &[&str] = &["RequestHooksArea"];

/// The areas in `worker_rs`'s `let areas: Vec<Rc<dyn NativeArea>> = vec![ … ];` whose names don't appear in
/// `sides_rs`, sorted. An entry is `Rc::new(Type(…))`, `Rc::new(Type::new(…))`, `Rc::new(var)` (resolved through
/// `let var = Type::new` in the same text) or `…twins_area()`.
pub fn missing_areas(worker_rs: &str, sides_rs: &str) -> Vec<String> {
    let start = "let areas: Vec<Rc<dyn NativeArea>> = vec![";
    let Some(from) = worker_rs.find(start) else {
        return vec![format!("no `{start}` in worker.rs")];
    };
    let list = &worker_rs[from + start.len()..];
    let list = &list[..list.find("];").unwrap_or(list.len())];

    let mut names = Vec::new();
    if list.contains("twins_area()") {
        names.push("twins_area".to_string());
    }
    let mut rest = list;
    while let Some(at) = rest.find("Rc::new(") {
        rest = &rest[at + "Rc::new(".len()..];
        let ident = identifier(rest);
        let after = &rest[ident.len()..];
        if ident.is_empty() {
            continue;
        }
        if after.starts_with('(') || after.starts_with("::") {
            names.push(ident.to_string());
        } else if let Some(ty) = constructor_of(worker_rs, ident) {
            names.push(ty);
        } else {
            names.push(format!("{ident} (no `let {ident} = Type::new` found)"));
        }
    }
    let mut missing: Vec<String> = names
        .into_iter()
        .filter(|n| !NOT_NEEDED.contains(&n.as_str()) && !sides_rs.contains(n.as_str()))
        .collect();
    missing.sort();
    missing.dedup();
    missing
}

fn identifier(text: &str) -> &str {
    let end = text
        .find(|c: char| !(c.is_alphanumeric() || c == '_'))
        .unwrap_or(text.len());
    &text[..end]
}

/// `Type` in `let var = Type::new…`.
fn constructor_of(text: &str, var: &str) -> Option<String> {
    let pattern = format!("let {var} = ");
    let at = text.find(&pattern)?;
    let ty = identifier(&text[at + pattern.len()..]);
    (!ty.is_empty()).then(|| ty.to_string())
}
