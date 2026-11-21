use std::process::Command;

fn runner(args: &[&str]) -> std::process::Output {
    Command::new(env!("CARGO_BIN_EXE_speedyspec-guide-examples"))
        .args(args)
        .output()
        .unwrap()
}

#[test]
fn usage_without_arguments() {
    let out = runner(&[]);
    assert_eq!(out.status.code(), Some(2));
    assert!(String::from_utf8_lossy(&out.stderr).contains("usage: speedyspec-guide-examples run"));
}

#[test]
fn unknown_side_is_refused() {
    let out = runner(&["run", "--side", "elsewhere", "--manifest", "x.json"]);
    assert_eq!(out.status.code(), Some(2));
    assert!(String::from_utf8_lossy(&out.stderr).contains("--side must be wordpress or runtime"));
}
