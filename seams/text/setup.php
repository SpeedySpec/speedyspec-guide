<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus the one line of `default-filters.php` that changes how kses works on trunk.
 *
 *  `wp_kses()` keeps the legacy parser unless `wp_kses_force_legacy_parser` returns false, and `default-filters.php`
 *  makes it return false, so a full WordPress filters HTML through the HTML API. The examples do the same.
 */

require __DIR__ . '/../basic-setup.php';

add_filter('wp_kses_force_legacy_parser', '__return_false');
