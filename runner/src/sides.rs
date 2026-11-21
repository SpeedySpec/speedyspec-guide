//! Booting PHP for each side, and preparing each example's request.
//!
//! The runtime side boots the native areas `speedyspec-php-runtime/src/worker.rs` boots. Both sides boot the
//! request-scoped `SpeedySpec\\Hooks\\Hook` registry (`RequestHooksArea`, copied in `request_hooks.rs` because the
//! worker's is private), because PHP always registers that class. `tests/areas.rs` fails when the worker boots an area,
//! or builds one, differently from this file.

use std::rc::Rc;

use speedyspec_container::Container;
use speedyspec_container_php::ContainerArea;
use speedyspec_php::{BootOptions, NativeArea, Output, Php};
use speedyspec_wp_hooks::HookStore;
use speedyspec_wp_hooks_memory::MemoryHookStore;
use speedyspec_wp_hooks_php::{HOOK_STORE, PhpHookStore, WpHooksArea};

use crate::Side;
use crate::manifest::{Manifest, ManifestExample};
use crate::request_hooks::{RequestHooks, RequestHooksArea};

/// Boots PHP once for the process. PHP's own output goes to stderr, so an example's stray output never mixes with
/// the JSON on stdout.
pub fn boot(side: Side) -> Result<Php, String> {
    let legacy = Rc::new(RequestHooks::new());
    let mut areas: Vec<Rc<dyn NativeArea>> = match side {
        Side::WordPress => Vec::new(),
        Side::Runtime => runtime_areas(),
    };
    areas.push(Rc::new(RequestHooksArea(legacy.clone())));
    let php = Php::boot(BootOptions {
        hooks: legacy,
        preload: &[],
        areas,
    })
    .map_err(|e| format!("booting PHP: {e}"))?;
    php.redirect_output(Output::Stderr);
    Ok(php)
}

/// The runtime worker's native areas.
fn runtime_areas() -> Vec<Rc<dyn NativeArea>> {
    let container = Rc::new(Container::new());
    let memory = Rc::new(MemoryHookStore::new());
    let hooks = WpHooksArea::new(container.clone(), memory);
    let container_area = ContainerArea::new("guide", container)
        .port::<dyn HookStore>(HOOK_STORE, |object| Rc::new(PhpHookStore::new(object)))
        .stateful(HOOK_STORE);
    vec![
        speedyspec_php_ext::twins_area(),
        Rc::new(container_area),
        Rc::new(hooks),
    ]
}

/// Prepares a fresh request for one example: on the WordPress side, WordPress's files, as the compat recorder loads
/// them; on the runtime side, nothing, because the port is native.
pub fn prepare(
    php: &Php,
    side: Side,
    manifest: &Manifest,
    example: &ManifestExample,
) -> Result<(), String> {
    if side == Side::Runtime || example.load.is_empty() {
        return Ok(());
    }
    let abspath = format!("{}/", manifest.wordpress_dir.display());
    let mut code = format!(
        "define('ABSPATH', {}); define('WPINC', 'wp-includes');",
        quote(&abspath)
    );
    for file in &example.load {
        code.push_str(&format!(" require ABSPATH . {};", quote(file)));
    }
    php.eval("speedyspec://guide/setup", &code)
        .map(|_| ())
        .map_err(|e| format!("loading WordPress's files: {e}"))
}

/// A PHP single-quoted string literal.
pub fn quote(text: &str) -> String {
    format!("'{}'", text.replace('\\', "\\\\").replace('\'', "\\'"))
}
