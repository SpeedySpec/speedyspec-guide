//! The runner's copies of files private to speedyspec-server's binaries must stay as upstream wrote them, so a re-pin
//! that changes one fails here instead of drifting silently.

use std::fs;
use std::path::Path;

/// `runner/src/scheduling.rs` is the runtime's `scheduling.rs` after a five-line header naming it a copy.
#[test]
fn scheduling_matches_the_runtime() {
    let root = Path::new(env!("CARGO_MANIFEST_DIR"));
    let copy = fs::read_to_string(root.join("src/scheduling.rs")).unwrap();
    let upstream =
        fs::read_to_string(root.join("server/crates/speedyspec-php-runtime/src/scheduling.rs")).unwrap();
    let header: Vec<&str> = copy.lines().take(5).collect();
    assert!(
        header[0].starts_with("//! A copy of speedyspec-php-runtime's `scheduling.rs`")
            && header[3] == "//! Upstream's description follows.",
        "the copy's header changed: {header:?}"
    );
    let body: String = copy.split_inclusive('\n').skip(5).collect();
    assert_eq!(
        body, upstream,
        "runner/src/scheduling.rs no longer matches the pinned runtime's; copy it again"
    );
}
