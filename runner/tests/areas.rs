use std::path::Path;

use speedyspec_guide_examples::areas_check::missing_areas;

const SIDES_OK: &str = r#"
    fn password_area(hooks: Rc<HookApi>) -> PasswordArea {
        let area = PasswordArea::new(hooks);
        area.bind_defaults();
        area
    }
    fn runtime_areas() {
        let hooks = WpHooksArea::new(container.clone(), memory);
        let container_area = ContainerArea::new("guide", container).port::<dyn HookStore>(HOOK_STORE, f).stateful(HOOK_STORE);
        let container_area = PasswordArea::ports(container_area);
        let password = password_area(hooks.api());
        let mut areas: Vec<Rc<dyn NativeArea>> = vec![speedyspec_php_ext::twins_area(), Rc::new(container_area), Rc::new(hooks), Rc::new(RequestHooksArea(legacy.clone()))];
        areas.extend(boot_database());
        areas.push(Rc::new(password));
    }
"#;

const DATABASE_OK: &str = r#"
    pub fn boot_database(hook_api: &Rc<HookApi>) -> Result<Vec<Rc<dyn NativeArea>>, String> {
        let wpdb = WpDbArea::new(hook_api.clone());
        let options = OptionsArea::new(wpdb.api());
        let cron = CronArea::new(options.api()).with_wake(wake);
        let areas: Vec<Rc<dyn NativeArea>> = vec![Rc::new(wpdb), Rc::new(options), Rc::new(cron)];
        Ok(areas)
    }
"#;

/// A worker like the real one: helper functions, its list, an extension from `boot_database`, pushes, then
/// `Php::boot`.
fn worker(entries: &str, extra: &str, after: &str) -> String {
    format!(
        "fn password_area(hooks: Rc<HookApi>) -> PasswordArea {{\n\
             let area = PasswordArea::new(hooks);\n\
             area.bind_defaults();\n\
             area\n\
         }}\n\
         pub fn run_worker(spec: WorkerSpec) -> i32 {{\n\
         let hooks = WpHooksArea::new(container.clone(), memory);\n\
         let container_area = ContainerArea::new(&spec.app, c.clone()).port::<dyn HookStore>(HOOK_STORE, |o| x(o)).stateful(HOOK_STORE);\n\
         let container_area = PasswordArea::ports(container_area);\n\
         let hook_api = hooks.api();\n\
         let password = password_area(hook_api.clone());\n\
         {extra}\n\
         let mut areas: Vec<Rc<dyn NativeArea>> = vec![\n{entries}\n];\n\
         let database = match crate::database::boot_database(&hook_api) {{\n\
             Ok(database_areas) => {{ areas.extend(database_areas); Some(()) }}\n\
             Err(_) => return 1,\n\
         }};\n\
         areas.push(Rc::new(password));\n\
         {after}\n\
         let php = Php::boot(BootOptions {{ areas }});\n\
         speedyspec_wp_db_php::WpDbArea::check_drop_in(&content);\n\
         }}"
    )
}

const BASE: &str = "speedyspec_php_ext::twins_area(),\nRc::new(container_area),\nRc::new(hooks),\nRc::new(RequestHooksArea(legacy.clone())),";

fn check(worker: &str, database: &str, sides: &str) -> Vec<String> {
    missing_areas(worker, &[database], &[sides, DATABASE_OK])
}

#[test]
fn matching_areas_pass() {
    assert_eq!(
        check(&worker(BASE, "", ""), DATABASE_OK, SIDES_OK),
        Vec::<String>::new()
    );
}

#[test]
fn finds_a_missing_area() {
    let w = worker(&format!("{BASE}\nRc::new(ObjectCacheArea::new()),"), "", "");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["ObjectCacheArea".to_string()]
    );
}

#[test]
fn a_name_inside_a_longer_name_is_not_a_match() {
    let w = worker(&format!("{BASE}\nRc::new(HooksArea::new()),"), "", "");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["HooksArea".to_string()]
    );
}

#[test]
fn a_name_only_in_a_comment_is_not_a_match() {
    let w = worker(&format!("{BASE}\nRc::new(ObjectCacheArea::new()),"), "", "");
    let sides = format!("{SIDES_OK}\n// ObjectCacheArea is not booted yet\n/* ObjectCacheArea */");
    assert_eq!(
        check(&w, DATABASE_OK, &sides),
        vec!["ObjectCacheArea".to_string()]
    );
}

#[test]
fn an_entry_it_cannot_read_is_a_failure() {
    let w = worker(&format!("{BASE}\nspeedyspec_options_php::area(),"), "", "");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["unrecognised area entry: speedyspec_options_php::area()".to_string()]
    );
}

#[test]
fn a_pushed_area_is_read() {
    let w = worker(
        BASE,
        "let crypto = CryptoArea::new(hook_api.clone());",
        "areas.push(Rc::new(crypto));",
    );
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["CryptoArea".to_string()]
    );
}

#[test]
fn a_pushed_entry_it_cannot_read_is_a_failure() {
    let w = worker(BASE, "", "areas.push(make_area());");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["unrecognised area entry: make_area()".to_string()]
    );
}

#[test]
fn an_extended_area_is_read() {
    let database = DATABASE_OK.replace(
        "Rc::new(cron)]",
        "Rc::new(cron), Rc::new(ObjectCacheArea::new(None))]",
    );
    assert_eq!(
        check(&worker(BASE, "", ""), &database, SIDES_OK),
        vec!["ObjectCacheArea".to_string()]
    );
}

#[test]
fn an_extension_from_no_readable_function_is_a_failure() {
    let w = worker(BASE, "", "areas.extend(more_areas);");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["unrecognised area extension: areas.extend(more_areas)".to_string()]
    );
    let w = worker(BASE, "", "areas.extend(vec![Rc::new(OptionsArea::new())]);");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec![
            "unrecognised area extension: areas.extend(vec![Rc::new(OptionsArea::new())])"
                .to_string()
        ]
    );
}

#[test]
fn an_extending_function_that_adds_after_its_list_is_a_failure() {
    let database = DATABASE_OK.replace(
        "Ok(areas)",
        "areas.push(Rc::new(ObjectCacheArea::new(None))); Ok(areas)",
    );
    assert_eq!(
        check(&worker(BASE, "", ""), &database, SIDES_OK),
        vec!["unrecognised area extension: areas.extend(database_areas)".to_string()]
    );
}

#[test]
fn another_use_of_the_list_is_a_failure() {
    let w = worker(BASE, "", "areas.insert(0, Rc::new(hooks));");
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["unrecognised use of the area list: areas.insert(0, Rc::new(hooks))".to_string()]
    );
}

#[test]
fn a_builder_call_the_runner_skips_is_a_failure() {
    let w = worker(BASE, "", "").replace(
        ".stateful(HOOK_STORE);",
        ".stateful(HOOK_STORE).bindings(spec.bindings.clone());",
    );
    assert_eq!(
        check(&w, DATABASE_OK, SIDES_OK),
        vec!["ContainerArea.bindings".to_string()]
    );
}

#[test]
fn a_builder_call_in_the_extending_function_is_checked() {
    let sides_database = DATABASE_OK.replace(".with_wake(wake)", "");
    assert_eq!(
        missing_areas(
            &worker(BASE, "", ""),
            &[DATABASE_OK],
            &[SIDES_OK, &sides_database]
        ),
        vec!["CronArea.with_wake".to_string()]
    );
}

#[test]
fn a_wiring_call_the_runner_skips_is_a_failure() {
    let sides = SIDES_OK.replace("area.bind_defaults();", "");
    assert_eq!(
        check(&worker(BASE, "", ""), DATABASE_OK, &sides),
        vec!["PasswordArea.bind_defaults".to_string()]
    );
    let sides = SIDES_OK.replace("PasswordArea::ports(container_area)", "container_area");
    assert_eq!(
        check(&worker(BASE, "", ""), DATABASE_OK, &sides),
        vec!["PasswordArea.ports".to_string()]
    );
}

#[test]
fn calls_after_php_boots_are_not_wiring() {
    // The worker's `WpDbArea::check_drop_in` runs per request, after `Php::boot`: the runner needn't make it.
    assert_eq!(
        check(&worker(BASE, "", ""), DATABASE_OK, SIDES_OK),
        Vec::<String>::new()
    );
}

#[test]
fn the_runtime_side_boots_every_worker_area() {
    let root = Path::new(env!("CARGO_MANIFEST_DIR"));
    let runtime = root.join("server/crates/speedyspec-php-runtime/src");
    let worker = std::fs::read_to_string(runtime.join("worker.rs")).unwrap();
    let mut modules = Vec::new();
    for entry in std::fs::read_dir(&runtime).unwrap() {
        let path = entry.unwrap().path();
        let name = path.file_name().unwrap().to_string_lossy().into_owned();
        if name.ends_with(".rs") && name != "worker.rs" && name != "main.rs" {
            modules.push(std::fs::read_to_string(&path).unwrap());
        }
    }
    let modules: Vec<&str> = modules.iter().map(String::as_str).collect();
    let runner: Vec<String> = ["sides.rs", "database.rs", "wake.rs", "request_hooks.rs"]
        .iter()
        .map(|f| std::fs::read_to_string(root.join("src").join(f)).unwrap())
        .collect();
    let runner: Vec<&str> = runner.iter().map(String::as_str).collect();
    assert_eq!(
        missing_areas(&worker, &modules, &runner),
        Vec::<String>::new()
    );
}
