<?php
// Whether random content redirects (/random/ and /random/<archive>/) are on, filtered by wp_enable_random_content_redirect; true by default.
$on = wp_is_random_content_redirect_enabled();
add_filter( 'wp_enable_random_content_redirect', '__return_false' );
return array( $on, wp_is_random_content_redirect_enabled() );
