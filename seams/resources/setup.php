<?php

declare(strict_types=1);

/**
 * Gives each Scripts, styles and fonts example a freshly installed site, booted as WordPress boots (see
 *  `boot.php`), with the administrator `admin` (user 1) logged in.
 *
 *  The site boots with no theme installed, so an example that needs theme data (theme.json, global styles) picks a
 *  bundled theme with {@link guide_theme()}. Deprecation and doing-it-wrong notices are left to the actions
 *  WordPress fires for them instead of raised as errors.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

/**
 * Makes a bundled theme the active theme and loads it as WordPress loads a theme: its `functions.php`, then
 *  `after_setup_theme`.
 *
 *  `init` has already run, so the theme's own `init` callbacks have not; an example calls the ones it shows.
 */
function guide_theme(string $stylesheet): void
{
    switch_theme($stylesheet);
    $theme = wp_get_theme($stylesheet);
    if ($theme->parent())
    {
        require_once $theme->get_template_directory() . '/functions.php';
    }
    require_once get_stylesheet_directory() . '/functions.php';
    do_action('after_setup_theme');
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}
