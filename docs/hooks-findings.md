# Hooks: findings for speedyspec-server

What writing the Hooks seam's pages found in speedyspec-server at commit `8fc498313cd9` that its compat records
(`compat/hooks/scenarios.json`, `compat/hooks/breaks.json`) don't capture. Each was run on WordPress 7.1.5 and again on trunk ce78d2d (7.2-RC1), with the same result, and on the
runtime with the guide's runner. The guide documents each as it is today; when the server records or fixes one, update
the page it names.

## 1. Replacing `$wp_actions` doesn't reset `did_action()`

```php
do_action( 'guide_a' );
$GLOBALS['wp_actions'] = array();
return did_action( 'guide_a' );
```

WordPress returns `0`; the runtime returns `1`. `$wp_filters` has the same behaviour and a recorded break
(`wp_filters_read_and_write`); `$wp_actions` has none. The example is
`seams/hooks/examples/global--wp_actions/porting-reset-before.php` (WordPress only). Documented on
`content/speedyspec/hooks/global/wp_actions.mdx` as a difference.

## 2. SpeedySpec's `WP_Hook` is `Countable` and has members of its own

`crates/speedyspec-wp-hooks-php/src/hooks.php` L140–141 declares
`#[\AllowDynamicProperties] final class WP_Hook implements Iterator, ArrayAccess, Countable`, with `speedyspec_`-prefixed
members (WordPress's is `final class WP_Hook implements Iterator, ArrayAccess`). `count( $wp_filter['x'] )` throws a
`TypeError` on WordPress and returns the number of priorities on the runtime. Documented on
`content/speedyspec/hooks/class/WP_Hook.mdx` as a difference.

## 3. The `remove_all_during_run` scenario doesn't test a removal during a run

Its name says it removes every callback while the hook runs, but its steps never call `remove_all_filters()`: a
callback on `f` adds a callback to another hook, then `f` runs. The guide cites it nowhere for during-run behaviour; `remove_during_run_later_at_current_priority` covers
`remove_filter()`, and no scenario covers `remove_all_filters()` during a run.

## 4. SpeedySpec doesn't declare `WP_Filter_Sentinel`

WordPress's `plugin.php` (7.1.5 and trunk) requires `class-wp-filter-sentinel.php` (L26), which declares
`final class WP_Filter_Sentinel {}`. The runtime answers `plugin.php` natively and declares no such class:
`class_exists( 'WP_Filter_Sentinel' )` is false (`seams/hooks/examples/class--WP_Filter_Sentinel/not-declared-on-speedyspec.php`).
Creating one fails on the runtime with `Error: Class "WP_Filter_Sentinel" not found`
(`seams/hooks/examples/class--WP_Filter_Sentinel/constructing-fails-on-speedyspec.php`). WordPress's
`WP_Ability::execute()` creates one as the default of `wp_pre_execute_ability`, so that code would fail the same way. Documented on `content/speedyspec/hooks/class/WP_Filter_Sentinel.mdx` as *breaks*.

## 5. Setting `WP_Hook::$callbacks` after reading it doesn't hold

```php
add_filter( 'guide_set', 'trim' );
$hook = $GLOBALS['wp_filter']['guide_set'];
$hook->callbacks;
$hook->callbacks = array();
return has_filter( 'guide_set' );
```

WordPress returns `false`; the runtime returns `true`. Reading `->callbacks` (`__get`, hooks.php L206–217) keeps a
pending copy; `__set` (L247–254) replaces the native callbacks but leaves that copy pending, and the next hook call's
write-back (L224–245) writes the old copy over the new value. The examples are
`seams/hooks/examples/class--WP_Hook--__set/`. Documented on `content/speedyspec/hooks/class/WP_Hook.mdx` as a
difference.
