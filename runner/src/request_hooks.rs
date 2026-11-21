//! The `SpeedySpec\Hooks\Hook` registry, emptied at the end of every request, as the runtime worker does it
//! (`RequestHooks` and `RequestHooksArea` in speedyspec-php-runtime's worker.rs, which are private to that binary).
//! The PHP callbacks it holds belong to their request: kept past it, the next example would run freed closures.

use std::cell::RefCell;
use std::rc::Rc;

use speedyspec_hooks::{AddOptions, Callback, CallbackId, HookError, Hooks, Value};
use speedyspec_hooks_memory::MemoryHooks;
use speedyspec_php::NativeArea;

pub struct RequestHooks(RefCell<Rc<MemoryHooks>>);

impl RequestHooks {
    pub fn new() -> RequestHooks {
        RequestHooks(RefCell::new(Rc::new(MemoryHooks::new())))
    }

    fn current(&self) -> Rc<MemoryHooks> {
        self.0.borrow().clone()
    }
}

impl Hooks for RequestHooks {
    fn add(
        &self,
        hook: &str,
        callback: Rc<Callback>,
        options: AddOptions,
    ) -> Result<CallbackId, HookError> {
        self.current().add(hook, callback, options)
    }
    fn remove(&self, hook: &str, id: CallbackId) -> Result<bool, HookError> {
        self.current().remove(hook, id)
    }
    fn remove_keyed(&self, hook: &str, key: &str, priority: i64) -> Result<bool, HookError> {
        self.current().remove_keyed(hook, key, priority)
    }
    fn has(&self, hook: &str) -> Result<bool, HookError> {
        self.current().has(hook)
    }
    fn has_keyed(&self, hook: &str, key: &str) -> Result<bool, HookError> {
        self.current().has_keyed(hook, key)
    }
    fn run(&self, hook: &str, args: &[Value]) -> Result<(), HookError> {
        self.current().run(hook, args)
    }
    fn filter(&self, hook: &str, value: Value, args: &[Value]) -> Result<Value, HookError> {
        self.current().filter(hook, value, args)
    }
    fn ran(&self, hook: &str) -> Result<u64, HookError> {
        self.current().ran(hook)
    }
}

/// Empties [`RequestHooks`] as each request ends (also after a fatal error).
pub struct RequestHooksArea(pub Rc<RequestHooks>);

impl NativeArea for RequestHooksArea {
    fn request_end(&self) {
        let old = self.0.0.replace(Rc::new(MemoryHooks::new()));
        drop(old);
    }
}
