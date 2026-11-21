use std::path::{Path, PathBuf};
use std::process::Command;

use serde_json::{Value, json};

fn fixtures() -> PathBuf {
    Path::new(env!("CARGO_MANIFEST_DIR")).join("tests/fixtures")
}

/// Runs the given examples (file names in tests/fixtures/examples) on one side and returns the result entries.
fn run(side: &str, examples: &[(&str, &[&str])]) -> Vec<Value> {
    let manifest = json!({
        "wordpressDir": fixtures().join("wordpress"),
        "examples": examples.iter().map(|(file, load)| json!({
            "id": file,
            "file": fixtures().join("examples").join(file),
            "load": load,
        })).collect::<Vec<_>>(),
    });
    let dir = tempfile::tempdir().unwrap();
    let path = dir.path().join("manifest.json");
    std::fs::write(&path, manifest.to_string()).unwrap();
    let out = Command::new(env!("CARGO_BIN_EXE_speedyspec-guide-examples"))
        .args(["run", "--side", side, "--manifest", path.to_str().unwrap()])
        .output()
        .unwrap();
    assert!(
        out.status.success(),
        "runner failed: {}",
        String::from_utf8_lossy(&out.stderr)
    );
    serde_json::from_slice::<Vec<Value>>(&out.stdout)
        .unwrap_or_else(|e| panic!("{e}: {}", String::from_utf8_lossy(&out.stdout)))
}

fn one(side: &str, file: &str, load: &[&str]) -> Value {
    run(side, &[(file, load)]).remove(0)
}

#[test]
fn returns_a_value() {
    assert_eq!(
        one("wordpress", "returns.php", &[]),
        json!({"id": "returns.php", "side": "wordpress", "output": "", "return": "20", "error": null})
    );
}

#[test]
fn echoes_and_returns() {
    let r = one("wordpress", "echoes.php", &[]);
    assert_eq!(r["output"], "a");
    assert_eq!(r["return"], "array (\n  0 => 1,\n)");
}

#[test]
fn no_return_is_one() {
    assert_eq!(one("wordpress", "no-return.php", &[])["return"], "1");
}

#[test]
fn throws_keeps_output() {
    let r = one("wordpress", "throws.php", &[]);
    assert_eq!(r["output"], "before");
    assert_eq!(r["error"], "RuntimeException: nope");
    assert_eq!(r["return"], Value::Null);
}

#[test]
fn fatal_does_not_stop_the_run() {
    let r = run("wordpress", &[("fatal.php", &[]), ("returns.php", &[])]);
    let error = r[0]["error"].as_str().unwrap();
    assert!(
        error.starts_with("Error: Call to undefined function") || error.starts_with("fatal:"),
        "{error}"
    );
    assert_eq!(r[1]["return"], "20");
}

#[test]
fn wordpress_files_are_loaded() {
    assert_eq!(
        one(
            "wordpress",
            "wordpress-only.php",
            &["wp-includes/plugin.php"]
        )["return"],
        "'hello from wordpress'"
    );
    let on_runtime = one("runtime", "wordpress-only.php", &["wp-includes/plugin.php"]);
    assert!(
        on_runtime["error"]
            .as_str()
            .unwrap()
            .contains("guide_fixture_hello"),
        "{on_runtime}"
    );
}

#[test]
fn native_hooks_on_the_runtime() {
    let r = one("runtime", "native-hooks.php", &[]);
    assert_eq!(r["side"], "runtime");
    assert_eq!(r["return"], "'a!'", "{r}");
}

#[test]
fn requests_are_fresh() {
    let r = run(
        "wordpress",
        &[("defines.php", &[]), ("checks-define.php", &[])],
    );
    assert_eq!(r[1]["return"], "false");
}

#[test]
fn speedyspec_hook_callbacks_do_not_outlive_their_request() {
    for side in ["wordpress", "runtime"] {
        let r = run(side, &[("hook-register.php", &[]), ("hook-fire.php", &[])]);
        assert_eq!(r[0]["return"], "1", "{side}: {}", r[0]);
        assert_eq!(
            r[1]["return"], "'v'",
            "{side}: a callback from the previous request ran: {}",
            r[1]
        );
    }
}
