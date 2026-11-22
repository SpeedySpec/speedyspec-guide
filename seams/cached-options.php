<?php

declare(strict_types=1);

/**
 * Keeps a seam's options in the object cache, for examples that write options but need no database.
 *
 *  An installed site autoloads its options into the cached `alloptions`, and keeps the others cached one by one; here
 *  those caches are the whole store, so `get_option()` reads them and `update_option()`, `add_option()` and
 *  `delete_option()` write back to them. `$wpdb` stands in only to report each write as saved and, for
 *  `delete_option()`, whether a cached option exists and is autoloaded. Transients live in the object cache, as on a
 *  site with a persistent cache. The seam must load the object cache and `option.php`.
 */

/** The database as the option writes see it: every write succeeds, and only the cached options exist. */
final class Guide_Saving_Wpdb
{
    public $options = 'wp_options';

    /** The arguments of the last prepared query; an option's row is looked up by the first. */
    private array $prepared = [];

    public function prepare($query, ...$args)
    {
        $this->prepared = $args;
        return $query;
    }

    public function update($table, $data, $where)
    {
        return 1;
    }

    public function query($query)
    {
        return 1;
    }

    public function delete($table, $where)
    {
        return 1;
    }

    public function get_var($query = null)
    {
        return null;
    }

    public function get_row($query = null, $output = null)
    {
        $name = $this->prepared[0] ?? null;
        if (!is_string($name))
        {
            return null;
        }
        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions[$name]))
        {
            return (object) ['autoload' => 'on'];
        }
        return false !== wp_cache_get($name, 'options') ? (object) ['autoload' => 'off'] : null;
    }

    public function get_results($query = null, $output = null)
    {
        return [];
    }

    public function strip_invalid_text_for_column($table, $column, $value)
    {
        return $value;
    }
}

/**
 * Starts the store with the given options, as an installed site would autoload them.
 *
 * @param array<string, mixed> $options
 *   The options by name; arrays and objects are stored serialized, as WordPress stores them.
 */
function guide_cached_options(array $options): void
{
    $GLOBALS['wpdb'] = new Guide_Saving_Wpdb();
    wp_using_ext_object_cache(true);
    wp_cache_set('alloptions', array_map('maybe_serialize', $options), 'options');
}
