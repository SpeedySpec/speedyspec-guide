use std::process::Command;

use serde_json::Value;

fn reflect(mode: &str) -> Vec<Value> {
    let out = Command::new(env!("CARGO_BIN_EXE_speedyspec-guide-examples"))
        .args(["reflect", "--mode", mode])
        .output()
        .unwrap();
    assert!(
        out.status.success(),
        "{}",
        String::from_utf8_lossy(&out.stderr)
    );
    serde_json::from_slice(&out.stdout).unwrap()
}

fn find<'a>(symbols: &'a [Value], id: &str) -> Option<&'a Value> {
    symbols.iter().find(|s| s["id"] == id)
}

#[test]
fn runtime_adds_the_hook_api() {
    let baseline = reflect("baseline");
    let runtime = reflect("runtime");
    for id in ["function:add_filter", "function:apply_filters"] {
        assert!(
            find(&runtime, id).is_some(),
            "{id} missing from the runtime"
        );
        assert!(find(&baseline, id).is_none(), "{id} in the baseline");
    }
    assert!(find(&baseline, "function:strlen").is_some());
    assert!(find(&runtime, "function:strlen").is_some());
    let add_filter = find(&runtime, "function:add_filter").unwrap();
    assert_eq!(add_filter["kind"], "function");
    assert_eq!(add_filter["file"], "native");
    assert_eq!(add_filter["line"], 0);
}

#[test]
fn signatures_print_defaults() {
    let runtime = reflect("runtime");
    let sig = find(&runtime, "function:add_filter").unwrap()["signature"]
        .as_str()
        .unwrap()
        .to_string();
    assert!(sig.contains("$priority = 10"), "{sig}");
    assert!(sig.contains("$accepted_args = 1"), "{sig}");
}

#[test]
fn constant_defaults_keep_their_source() {
    let baseline = reflect("baseline");
    let sig = find(&baseline, "function:htmlspecialchars").unwrap()["signature"]
        .as_str()
        .unwrap()
        .to_string();
    assert!(
        sig.contains("$flags = ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401"),
        "{sig}"
    );
}

#[test]
fn classes_and_methods_are_listed() {
    let baseline = reflect("baseline");
    assert_eq!(
        find(&baseline, "class:ArrayObject").unwrap()["kind"],
        "class"
    );
    let m = find(&baseline, "method:ArrayObject::count").unwrap();
    assert_eq!(m["kind"], "method");
    assert!(
        m["signature"]
            .as_str()
            .unwrap()
            .starts_with("public count("),
        "{m}"
    );
}

#[test]
fn runtime_has_every_worker_area() {
    let baseline = reflect("baseline");
    let runtime = reflect("runtime");
    for id in [
        "function:SpeedySpec\\Runtime\\report_next_wake",
        "function:wp_fast_hash",
        "function:wp_hash_password",
        "function:wp_text_diff",
        "function:wp_read_video_metadata",
    ] {
        assert!(
            find(&runtime, id).is_some(),
            "{id} missing from the runtime"
        );
        assert!(find(&baseline, id).is_none(), "{id} in the baseline");
    }
}

/// The database areas boot only when the environment names a database, as in the worker.
#[test]
fn database_areas_follow_db_name() {
    let runtime = reflect("runtime");
    let configured = std::env::var("DB_NAME").is_ok_and(|name| !name.is_empty());
    for id in [
        "class:wpdb",
        "function:wp_cache_get",
        "function:get_option",
        "function:wp_schedule_event",
    ] {
        assert_eq!(find(&runtime, id).is_some(), configured, "{id}");
    }
}
