<?php
// Hooked to xmlrpc_methods: outside production, removes pingback.ping.
add_filter( 'wp_should_disable_pings_for_environment', '__return_true' );
return array_keys( wp_maybe_disable_xmlrpc_pingback_for_environment( array( 'pingback.ping' => 'x', 'wp.getPosts' => 'y' ) ) );
