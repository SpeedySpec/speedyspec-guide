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

do_action('init');
