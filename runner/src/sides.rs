//! Booting PHP for each side, and preparing each example's request.
//!
//! The runtime side boots the native areas `speedyspec-php-runtime/src/worker.rs` boots, built the same way, in the
//! same order. Both sides boot the request-scoped `SpeedySpec\\Hooks\\Hook` registry (`RequestHooksArea`, copied in
//! `request_hooks.rs` because the worker's is private), because PHP always registers that class. The worker's
//! `NextWakeArea` and `boot_database` are private too: `wake.rs` and `database.rs` are copies. `tests/areas.rs` fails
//! when the worker boots an area, or builds or wires one, differently from this file.

use std::rc::Rc;

use speedyspec_container::Container;
use speedyspec_container_php::ContainerArea;
use speedyspec_php::{BootOptions, NativeArea, Output, Php};
use speedyspec_wp_crypto_php::CryptoArea;
use speedyspec_wp_crypto_sodium::Sodium;
use speedyspec_wp_hooks::{HookStore, WpHookApi};
use speedyspec_wp_hooks_memory::MemoryHookStore;
use speedyspec_wp_hooks_php::{HOOK_STORE, PhpHookStore, WpHooksArea};
use speedyspec_wp_media_contracts::{MediaInfo, MediaReader, MediaSource, ProbeLimits, ReadError};
use speedyspec_wp_media_php::MediaArea;
use speedyspec_wp_meta_php::MetaArea;
use speedyspec_wp_password_php::PasswordArea;
use speedyspec_wp_posts_php::PostsArea;
use speedyspec_wp_text_diff_php::TextDiffArea;

use crate::Side;
use crate::database::{WorkerDatabase, boot_database, database_config};
use crate::manifest::{Manifest, ManifestExample};
use crate::request_hooks::{RequestHooks, RequestHooksArea};
use crate::wake::{NextWake, NextWakeArea};

/// PHP, booted once for the process, and the runtime side's database when its environment names one.
pub struct Booted {
    pub php: Php,
    database: Option<WorkerDatabase>,
}

impl Booted {
    /// Ends an example as the worker ends a request: a transaction it left open is rolled back, and the
    /// connections stay.
    pub fn end_example(&self) -> Result<(), String> {
        match &self.database {
            Some(database) => database
                .registry
                .reset_all()
                .map_err(|e| format!("an open transaction: {e}")),
            None => Ok(()),
        }
    }
}

/// Boots PHP once for the process. PHP's own output goes to stderr, so an example's stray output never mixes with
/// the JSON on stdout.
pub fn boot(side: Side) -> Result<Booted, String> {
    let legacy = Rc::new(RequestHooks::new());
    let (areas, database) = match side {
        Side::WordPress => (
            vec![Rc::new(RequestHooksArea(legacy.clone())) as Rc<dyn NativeArea>],
            None,
        ),
        Side::Runtime => runtime_areas(&legacy)?,
    };
    let php = Php::boot(BootOptions {
        hooks: legacy,
        preload: &[],
        areas,
    })
    .map_err(|e| format!("booting PHP: {e}"))?;
    php.redirect_output(Output::Stderr);
    Ok(Booted { php, database })
}

/// WordPress's password functions, with WordPress's rules bound in `container` under their pluggable ports.
fn password_area(hooks: Rc<WpHookApi>, container: &Rc<Container>, sodium: Sodium) -> PasswordArea {
    let area = PasswordArea::new(hooks, container.clone(), Rc::new(sodium));
    area.bind_defaults();
    area
}

/// `wp_text_diff()`, with WordPress's implementation bound in `container` under its pluggable port.
fn text_diff_area(hooks: Rc<WpHookApi>, container: &Rc<Container>) -> TextDiffArea {
    let area = TextDiffArea::new(hooks, container.clone());
    area.bind_defaults();
    area
}

/// A reader that always fails, as the worker's `MediaUnavailable` does when it can't start probe children. The
/// worker reads media in `media-probe` children of its own binary, through a shared result cache; the runner has
/// neither, and reflection and the examples so far don't read media. Declaring the API needs only a bound reader.
struct MediaUnavailable;

impl MediaReader for MediaUnavailable {
    fn read(&self, _: MediaSource, _: &ProbeLimits) -> Result<MediaInfo, ReadError> {
        Err(ReadError::Crashed(
            "the guide's examples runner reads no media".to_string(),
        ))
    }
}

/// WordPress's media functions, over [`MediaUnavailable`].
fn media_area(hooks: Rc<WpHookApi>, container: &Rc<Container>) -> MediaArea {
    let limits = ProbeLimits::default();
    let area = MediaArea::new(hooks, container.clone(), limits);
    area.bind_defaults(Rc::new(MediaUnavailable));
    area
}

/// The runtime side's areas, and its database if it has one.
type RuntimeAreas = (Vec<Rc<dyn NativeArea>>, Option<WorkerDatabase>);

/// The runtime worker's native areas, in its order, and its database when `DB_NAME` is set. An unreachable or
/// refused database is an error, as it is for the worker.
fn runtime_areas(legacy: &Rc<RequestHooks>) -> Result<RuntimeAreas, String> {
    let sodium = Sodium::init().map_err(|e| format!("libsodium: {e}"))?;
    let database_config = database_config(|key| std::env::var(key).ok())?;
    let container = Rc::new(Container::new());
    let memory = Rc::new(MemoryHookStore::new());
    let hooks = WpHooksArea::new(container.clone(), memory);
    let container_area = ContainerArea::new("guide", container.clone())
        .port::<dyn HookStore>(HOOK_STORE, |object| Rc::new(PhpHookStore::new(object)))
        .stateful(HOOK_STORE)
        // The worker binds the app's configured services here; examples run with none.
        .bindings(Vec::new());
    let hook_api = hooks.api();
    let media = media_area(hook_api.clone(), &container);
    let container_area = PostsArea::ports(MetaArea::ports(
        media.ports(TextDiffArea::ports(PasswordArea::ports(container_area))),
    ));
    let next_wake = NextWake::new();
    let crypto = CryptoArea::new(hook_api.clone(), sodium);
    let password = password_area(hook_api.clone(), &container, sodium);
    let text_diff = text_diff_area(hook_api.clone(), &container);
    let mut areas: Vec<Rc<dyn NativeArea>> = vec![
        speedyspec_php_ext::twins_area(),
        Rc::new(container_area),
        Rc::new(hooks),
        Rc::new(RequestHooksArea(legacy.clone())),
        Rc::new(NextWakeArea(next_wake.clone())),
    ];
    let database = match database_config {
        Some(config) => {
            let (database, database_areas) =
                boot_database(config, &container, &hook_api, next_wake.clone())
                    .map_err(|failure| failure.event().1.to_string())?;
            areas.extend(database_areas);
            Some(database)
        }
        None => None,
    };
    areas.push(Rc::new(crypto));
    areas.push(Rc::new(password));
    areas.push(Rc::new(text_diff));
    areas.push(Rc::new(media));
    Ok((areas, database))
}

/// Prepares a fresh request for one example: its time limit, and on the WordPress side, WordPress's files, as the
/// compat recorder loads them, then the seam's setup file (the runtime side loads nothing: its port is native).
pub fn prepare(
    php: &Php,
    side: Side,
    manifest: &Manifest,
    example: &ManifestExample,
) -> Result<(), String> {
    let mut code = format!("set_time_limit({});", manifest.timeout_seconds);
    if side == Side::WordPress && !example.load.is_empty() {
        let abspath = format!("{}/", manifest.wordpress_dir.display());
        code.push_str(&format!(
            " define('ABSPATH', {}); define('WPINC', 'wp-includes');",
            quote(&abspath)
        ));
        for file in &example.load {
            code.push_str(&format!(" require ABSPATH . {};", quote(file)));
        }
    }
    if side == Side::WordPress {
        if let Some(setup) = &example.setup {
            code.push_str(&format!(
                " define('GUIDE_MULTISITE', {}); require {};",
                example.multisite,
                quote(&setup.display().to_string())
            ));
        }
    }
    php.eval("speedyspec://guide/setup", &code)
        .map(|_| ())
        .map_err(|e| format!("loading WordPress's files: {e}"))
}

/// A PHP single-quoted string literal.
pub fn quote(text: &str) -> String {
    format!("'{}'", text.replace('\\', "\\\\").replace('\'', "\\'"))
}
