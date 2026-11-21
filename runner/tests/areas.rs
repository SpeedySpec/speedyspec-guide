use std::path::Path;

use speedyspec_guide_examples::areas_check::missing_areas;

const SIDES_OK: &str = r#"
    let container_area = ContainerArea::new("guide", container).port::<dyn HookStore>(HOOK_STORE, f).stateful(HOOK_STORE);
    let hooks = WpHooksArea::new(container.clone(), memory);
    vec![speedyspec_php_ext::twins_area(), Rc::new(container_area), Rc::new(hooks)];
    areas.push(Rc::new(RequestHooksArea(legacy.clone())));
"#;

fn worker(entries: &str, extra: &str) -> String {
    format!(
        "let container_area = ContainerArea::new(&spec.app, c.clone()).port::<dyn HookStore>(HOOK_STORE, |o| x(o)).stateful(HOOK_STORE);\n\
         let hooks = WpHooksArea::new(container.clone(), memory);\n\
         {extra}\n\
         let areas: Vec<Rc<dyn NativeArea>> = vec![\n{entries}\n];"
    )
}

const BASE: &str = "speedyspec_php_ext::twins_area(),\nRc::new(container_area),\nRc::new(hooks),\nRc::new(RequestHooksArea(legacy.clone())),";

#[test]
fn matching_areas_pass() {
    assert_eq!(
        missing_areas(&worker(BASE, ""), SIDES_OK),
        Vec::<String>::new()
    );
}

#[test]
fn finds_a_missing_area() {
    let w = worker(&format!("{BASE}\nRc::new(OptionsArea::new()),"), "");
    assert_eq!(missing_areas(&w, SIDES_OK), vec!["OptionsArea".to_string()]);
}

#[test]
fn a_name_inside_a_longer_name_is_not_a_match() {
    let w = worker(&format!("{BASE}\nRc::new(HooksArea::new()),"), "");
    assert_eq!(missing_areas(&w, SIDES_OK), vec!["HooksArea".to_string()]);
}

#[test]
fn a_name_only_in_a_comment_is_not_a_match() {
    let w = worker(&format!("{BASE}\nRc::new(OptionsArea::new()),"), "");
    let sides = format!("{SIDES_OK}\n// OptionsArea is not booted yet\n/* OptionsArea */");
    assert_eq!(missing_areas(&w, &sides), vec!["OptionsArea".to_string()]);
}

#[test]
fn an_entry_it_cannot_read_is_a_failure() {
    let w = worker(&format!("{BASE}\nspeedyspec_options_php::area(),"), "");
    assert_eq!(
        missing_areas(&w, SIDES_OK),
        vec!["unrecognised area entry: speedyspec_options_php::area()".to_string()]
    );
}

#[test]
fn areas_added_after_the_list_are_a_failure() {
    let w = format!(
        "{}\nareas.push(Rc::new(OptionsArea::new()));",
        worker(BASE, "")
    );
    assert_eq!(
        missing_areas(&w, SIDES_OK),
        vec!["the worker adds areas after the list (areas.push)".to_string()]
    );
}

#[test]
fn a_builder_call_the_runner_skips_is_a_failure() {
    let w = worker(BASE, "").replace(
        ".stateful(HOOK_STORE);",
        ".stateful(HOOK_STORE).bindings(spec.bindings.clone());",
    );
    assert_eq!(
        missing_areas(&w, SIDES_OK),
        vec!["ContainerArea.bindings".to_string()]
    );
}

#[test]
fn the_runtime_side_boots_every_worker_area() {
    let root = Path::new(env!("CARGO_MANIFEST_DIR"));
    let worker =
        std::fs::read_to_string(root.join("server/crates/speedyspec-php-runtime/src/worker.rs"))
            .unwrap();
    let sides = std::fs::read_to_string(root.join("src/sides.rs")).unwrap();
    assert_eq!(missing_areas(&worker, &sides), Vec::<String>::new());
}
