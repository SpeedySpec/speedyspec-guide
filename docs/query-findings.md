# Query (wpdb): findings for speedyspec-server

What writing the `wpdb` part of the Query seam found in speedyspec-server at commit `219cc61e7a4f` that its compat
records (`compat/wp-db/scenarios.json`, `compat/wp-db/breaks.json`) don't capture. The guide documents each as it is
today; when the server records or fixes one, update the page it names.

## 1. `unset()` on a declared public property throws

`crates/speedyspec-wp-db-php/src/lib.rs` (L13–15) lists `unset_public_property` as a documented break, but
`breaks.json` has no entry for it and no scenario covers it. The facade declares `wpdb`'s public properties
(`$show_errors`, `$last_error`, `$num_rows`, the table names, …) as PHP 8.4 property hooks over the port, and PHP
refuses to unset a hooked property:

```php
unset( $GLOBALS['wpdb']->show_errors );
```

WordPress removes the property; the runtime throws `Error: Cannot unset hooked property wpdb::$show_errors` (checked
with PHP 8.4.27 on a class with the same property shape). Documented on `content/speedyspec/query/class/wpdb.mdx` as a
difference.

## 2. A `wp-content/db.php` drop-in is refused

`WpDbArea::check_drop_in()` refuses a site with a `db.php` drop-in (test `speedyspec-wp-db-php::php::drop_in_refused`),
and the worker won't serve it. WordPress loads the drop-in in place of `wpdb`. This is by design, but it is not in
`breaks.json`. Documented on `content/speedyspec/query/class/wpdb.mdx` as a difference.

## 3. Not differences from WordPress, but gaps in SpeedySpec's own API

- **PHP can't bind the request state.** `SpeedySpec\WpDb\WpdbState` is declared for PHP, and `PhpWpdbState` adapts it,
  but the worker declares only the hook store as a port PHP may bind (`ContainerArea::port`), so a binding made from
  PHP is never bridged, `make_port` fails and `ResolvedWpdbState` falls back to memory. Only the test binds it, from
  Rust.
- **PHP can't override a handler.** `speedyspec-wp-db-php/src/lib.rs` says PHP may override one of the handlers bound
  by `register_wpdb_handlers()`, but no handler key is declared as a port either. A PHP binding under a handler key
  (`SpeedySpec\WpDb\QueryHandler`, …) would make `make_port` fail, and the `wpdb` method would then fail with
  `NoHandler` rather than fall back. The test `speedyspec-wp-db::messages::php_can_override` binds a Rust handler.
- **Only MySQL in the worker.** `boot_database()` registers `MySqlEngineFactory` alone, so the SQLite and PostgreSQL
  engines, which pass the `wp-db` replay and WordPress's database tests with their listed failures, can't be chosen.
