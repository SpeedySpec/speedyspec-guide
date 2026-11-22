<?php
// Whether the fatal error handler is on: not when WP_DISABLE_FATAL_ERROR_HANDLER is true; wp_fatal_error_handler_enabled filters it.
$plain = wp_is_fatal_error_handler_enabled();
add_filter( 'wp_fatal_error_handler_enabled', '__return_false' );
return array( $plain, wp_is_fatal_error_handler_enabled() );
