use std::path::Path;

use speedyspec_guide_examples::areas_check::missing_areas;

#[test]
fn finds_a_missing_area() {
    let worker = r#"
        let container_area = ContainerArea::new(&spec.app, container.clone()).port::<dyn HookStore>(HOOK_STORE, f);
        let hooks = WpHooksArea::new(container.clone(), memory);
        let areas: Vec<Rc<dyn NativeArea>> = vec![
            speedyspec_php_ext::twins_area(),
            Rc::new(container_area),
            Rc::new(hooks),
            Rc::new(RequestHooksArea(legacy.clone())),
            Rc::new(OptionsArea::new()),
        ];
    "#;
    let sides = "twins_area() ContainerArea::new WpHooksArea::new";
    assert_eq!(
        missing_areas(worker, sides),
        vec!["OptionsArea".to_string()]
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
