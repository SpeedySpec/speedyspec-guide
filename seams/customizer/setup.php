<?php

declare(strict_types=1);

/**
 * Gives each Customizer example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1) logged in and the Customizer's classes loaded.
 *
 *  {@link guide_customizer()} makes a manager with WordPress's own panels, sections, settings and controls, as the
 *  Customizer has them on `customize_register`.
 */

require __DIR__ . '/../boot.php';
require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

/**
 * Makes a Customizer manager with WordPress's default controls registered.
 *
 * @param array<string, mixed> $args
 *   The manager's arguments, such as a changeset UUID.
 */
function guide_customizer(array $args = []): WP_Customize_Manager
{
    $manager = new WP_Customize_Manager($args);
    $GLOBALS['wp_customize'] = $manager;
    $manager->register_controls();
    return $manager;
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}
