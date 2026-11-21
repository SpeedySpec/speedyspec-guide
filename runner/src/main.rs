//! `speedyspec-guide-examples`: runs the SpeedySpec Guide's examples in the embedded PHP, on WordPress or on the
//! SpeedySpec runtime's native port, and lists the runtime's PHP API through Reflection.
//!
//! A plain executor: the guide's TypeScript toolchain writes the manifest, compares the results and reports them.

use std::process::ExitCode;

use speedyspec_hooks::Value;
use speedyspec_php::Php;

mod manifest;
mod sides;

use manifest::{Manifest, RunResult};

const DRIVER: &str = include_str!("driver.php");

const USAGE: &str = "usage: speedyspec-guide-examples run --side <wordpress|runtime> --manifest <file> | reflect --mode <baseline|runtime>";

/// Which code an example runs against.
#[derive(Clone, Copy, Debug, PartialEq, Eq)]
pub enum Side {
    WordPress,
    Runtime,
}

impl Side {
    fn name(self) -> &'static str {
        match self {
            Side::WordPress => "wordpress",
            Side::Runtime => "runtime",
        }
    }

    fn parse(text: &str) -> Option<Side> {
        match text {
            "wordpress" => Some(Side::WordPress),
            "runtime" => Some(Side::Runtime),
            _ => None,
        }
    }
}

enum Command {
    Run { side: Side, manifest: String },
    Reflect { runtime: bool },
}

fn parse(args: &[String]) -> Result<Command, String> {
    let args: Vec<&str> = args.iter().map(String::as_str).collect();
    match args.as_slice() {
        ["run", "--side", side, "--manifest", manifest] => {
            let side = Side::parse(side).ok_or("--side must be wordpress or runtime")?;
            Ok(Command::Run {
                side,
                manifest: (*manifest).to_string(),
            })
        }
        ["reflect", "--mode", "baseline"] => Ok(Command::Reflect { runtime: false }),
        ["reflect", "--mode", "runtime"] => Ok(Command::Reflect { runtime: true }),
        ["reflect", "--mode", _] => Err("--mode must be baseline or runtime".to_string()),
        _ => Err(USAGE.to_string()),
    }
}

fn main() -> ExitCode {
    let args: Vec<String> = std::env::args().skip(1).collect();
    let command = match parse(&args) {
        Ok(command) => command,
        Err(why) => {
            if why != USAGE {
                eprintln!("{why}");
            }
            eprintln!("{USAGE}");
            return ExitCode::from(2);
        }
    };
    let result: Result<String, String> = match command {
        Command::Run { side, manifest } => run(side, &manifest),
        Command::Reflect { .. } => Err("reflect is not implemented yet".to_string()),
    };
    match result {
        Ok(json) => {
            println!("{json}");
            ExitCode::SUCCESS
        }
        Err(why) => {
            eprintln!("{why}");
            ExitCode::FAILURE
        }
    }
}

/// Runs every example of the manifest on one side, each in a fresh request, and returns the results as JSON.
fn run(side: Side, manifest: &str) -> Result<String, String> {
    let text = std::fs::read_to_string(manifest).map_err(|e| format!("{manifest}: {e}"))?;
    let manifest: Manifest =
        serde_json::from_str(&text).map_err(|e| format!("{}: {e}", manifest))?;
    let php = sides::boot(side)?;
    let mut results = Vec::new();
    for example in &manifest.examples {
        results.push(run_one(&php, side, &manifest, example));
    }
    serde_json::to_string(&results).map_err(|e| e.to_string())
}

fn run_one(
    php: &Php,
    side: Side,
    manifest: &Manifest,
    example: &manifest::ManifestExample,
) -> RunResult {
    let failed = |why: String| RunResult {
        id: example.id.clone(),
        side: side.name().to_string(),
        output: String::new(),
        returned: None,
        error: Some(why),
    };
    if let Err(e) = php.restart_request() {
        return failed(format!("fatal: starting a request: {e}"));
    }
    if let Err(why) = sides::prepare(php, side, manifest, example) {
        return failed(format!("fatal: {why}"));
    }
    if let Err(e) = php.eval("speedyspec://guide/driver", DRIVER) {
        return failed(format!("fatal: loading the driver: {e}"));
    }
    let file = Value::Str(example.file.display().to_string());
    match php.call(&Value::Str("speedyspec_guide_example".into()), &[file]) {
        Ok(Value::Str(json)) => match serde_json::from_str::<serde_json::Value>(&json) {
            Ok(v) => RunResult {
                id: example.id.clone(),
                side: side.name().to_string(),
                output: v["output"].as_str().unwrap_or_default().to_string(),
                returned: v["return"].as_str().map(str::to_string),
                error: v["error"].as_str().map(str::to_string),
            },
            Err(e) => failed(format!("fatal: the driver's output: {e}")),
        },
        Ok(other) => failed(format!("fatal: the driver returned {other:?}")),
        Err(e) => failed(format!("fatal: {e}")),
    }
}
