# Object Cache: findings for speedyspec-server

What writing the Object Cache seam's pages found in speedyspec-server at commit `219cc61e7a4f` that its compat records
(`compat/object-cache/scenarios.json`, `compat/object-cache/breaks.json`) don't capture. Each comes from reading the
runtime's source (`crates/speedyspec-wp-object-cache-php/src/wp-object-cache.php`) against WordPress trunk. The guide
documents each as it is today; when the server records or fixes one, update the page it names.

## 1. `WP_Object_Cache` has no `is_valid_key()` or `_exists()`

WordPress's class declares `protected function is_valid_key( $key )` (`class-wp-object-cache.php` L142) and
`protected function _exists( $key, $group )` (L180). SpeedySpec's class (wp-object-cache.php L238–389) declares
neither. A subclass that calls `$this->is_valid_key()` or `$this->_exists()`, as some drop-in-style caches do, fails
with `Error: Call to undefined method`. The scenarios use only public methods and functions, so no break records it.
Documented on `content/speedyspec/object-cache/class/WP_Object_Cache.mdx` as a difference.

## 2. The `*_salted` functions aren't declared

`wp_cache_get_salted()`, `wp_cache_set_salted()`, `wp_cache_get_multiple_salted()` and `wp_cache_set_multiple_salted()`
(WordPress 6.9) are in neither the object-cache area nor the runtime's PHP API (`generated/inventory-runtime.json`).
WordPress defines them in `cache-compat.php`, which only exists where WordPress's own PHP is loaded. No scenario and no
test runs them on SpeedySpec. Documented on each function's page as a difference.

## 3. `WP_Object_Cache` has a destructor

SpeedySpec's class adds `__destruct()` (wp-object-cache.php L246–249), which drops the object's Rust cache. WordPress's
class has none, so a subclass's own `__destruct()` that doesn't call `parent::__destruct()` keeps the Rust cache until
the request ends. Listed in `seams/object-cache/seam.yaml`; documented on the class page.

## 4. WordPress's cache tests can't be cited as tests

`speedyspec-wp-object-cache-php`'s `wordpress` and `wordpress_multisite` runs report `documented_breaks_are_listed`
and `wordpress_cache_tests_pass` from `tests/common/mod.rs`, not from their own files, so the guide's test citations
(`<crate>::<file>::<name>`) can't name them. The pages cite the source lines of the check instead.
