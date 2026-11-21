//! `speedyspec-guide-examples`: runs the SpeedySpec Guide's examples in the embedded PHP, on WordPress or on the
//! SpeedySpec runtime's native port, and lists the runtime's PHP API through Reflection.
//!
//! A plain executor: the guide's TypeScript toolchain writes the manifest, compares the results and reports them.

use std::process::ExitCode;

const USAGE: &str = "usage: speedyspec-guide-examples run --side <wordpress|runtime> --manifest <file> | reflect --mode <baseline|runtime>";

/// Which code an example runs against.
#[derive(Clone, Copy, Debug, PartialEq, Eq)]
pub enum Side {
    WordPress,
    Runtime,
}

impl Side {
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
            Ok(Command::Run { side, manifest: (*manifest).to_string() })
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
    let result = match command {
        Command::Run { .. } => Err("run is not implemented yet".to_string()),
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
