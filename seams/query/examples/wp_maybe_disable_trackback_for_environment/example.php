<?php
// Hooked to pre_trackback_post: outside production, answers a trackback with an error and stops; otherwise does nothing.
add_filter( 'wp_should_disable_pings_for_environment', '__return_false' );
return wp_maybe_disable_trackback_for_environment();
