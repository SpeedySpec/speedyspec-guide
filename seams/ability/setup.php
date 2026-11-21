<?php

declare(strict_types=1);

/**
 * The shared basic setup, with `init` fired, as the Abilities API's registries need.
 *
 *  The registries refuse to start before `init`, so `init` has run. There is no logged-in user: an example that
 *  needs a capability grants it through `user_has_cap`. `_doing_it_wrong()` notices are printed as
 *  `doing_it_wrong: <function>: <message>`, so an example shows where WordPress refuses a call.
 */

require __DIR__ . '/../basic-setup.php';

add_action('doing_it_wrong_run', static function ($function, $message) {
    echo 'doing_it_wrong: ', $function, ': ', strip_tags($message), "\n";
}, 10, 2);
add_filter('doing_it_wrong_trigger_error', '__return_false');

// class-wpdb.php's result types, which get_post() takes.
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}
unset($guide_name);

// The one line of default-filters.php the schema validators rely on: %l lists in their messages.
add_filter('wp_sprintf', 'wp_sprintf_l', 10, 2);
add_filter('pre_option_home', static fn () => 'http://example.org');
add_filter('pre_option_siteurl', static fn () => 'http://example.org');

do_action('init');

/**
 * Registers WordPress's own ability categories and abilities, as `default-filters.php` hooks them.
 *
 *  With no database, the roles come from a `WP_Roles` holding an administrator role, as `wp_roles()` would load
 *  them, and one public post type, `guide_note`, is exposed to abilities, so the content ability is registered.
 */
function guide_core_abilities(): void
{
    $roles = (new ReflectionClass('WP_Roles'))->newInstanceWithoutConstructor();
    $roles->roles = ['administrator' => ['name' => 'Administrator', 'capabilities' => ['read' => true, 'list_users' => true]]];
    $roles->init_roles();
    $GLOBALS['wp_roles'] = $roles;
    register_post_type('guide_note', ['public' => true, 'show_in_abilities' => true, 'rewrite' => false, 'query_var' => false]);
    add_action('wp_abilities_api_categories_init', 'wp_register_core_ability_categories');
    add_action('wp_abilities_api_init', 'wp_register_core_abilities');
}

/** Calls a private method of one of WordPress's ability classes, to show what it does on its own. */
function guide_private(object $object, string $method, ...$args)
{
    return Closure::bind(fn () => $this->$method(...$args), $object, get_class($object))();
}
