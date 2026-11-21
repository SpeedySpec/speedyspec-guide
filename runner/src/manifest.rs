//! The manifest the toolchain writes, and the results the runner prints.

use std::path::PathBuf;

use serde::{Deserialize, Serialize};

#[derive(Debug, Deserialize)]
#[serde(rename_all = "camelCase")]
pub struct Manifest {
    /// The extracted WordPress release (WordPress side).
    pub wordpress_dir: PathBuf,
    pub examples: Vec<ManifestExample>,
    /// The most an example may run, in seconds of CPU time, before PHP stops it (`set_time_limit`).
    #[serde(default = "default_timeout")]
    pub timeout_seconds: u64,
}

fn default_timeout() -> u64 {
    10
}

#[derive(Debug, Deserialize)]
pub struct ManifestExample {
    pub id: String,
    /// The example's PHP file, absolute.
    pub file: PathBuf,
    /// WordPress files to load first, relative to `wordpress_dir` (WordPress side only).
    #[serde(default)]
    pub load: Vec<String>,
}

/// What one example printed, returned (`var_export`) and threw, on one side.
#[derive(Debug, Serialize, Deserialize)]
pub struct RunResult {
    pub id: String,
    pub side: String,
    pub output: String,
    #[serde(rename = "return")]
    pub returned: Option<String>,
    pub error: Option<String>,
}
