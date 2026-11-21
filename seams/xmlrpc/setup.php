<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus a site the XML-RPC server describes and a request nobody is logged in to.
 *
 *  With no database, the options the server reads come from filters: the site is `http://example.org`, titled
 *  `Guide`; reading any other option throws, naming it. No authentication handler is hooked, so every username and
 *  password is refused, as they are for an unknown user, and the methods that need a login answer with their fault.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
    'blogname' => 'Guide',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
foreach (['OBJECT', 'OBJECT_K', 'ARRAY_A', 'ARRAY_N'] as $guide_name)
{
    defined($guide_name) || define($guide_name, $guide_name);
}
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
$GLOBALS['wp_version'] = '7.2';
unset($guide_name, $guide_value);
