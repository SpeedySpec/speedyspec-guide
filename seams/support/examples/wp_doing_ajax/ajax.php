<?php
// Whether the request is an AJAX request (DOING_AJAX), as wp_doing_ajax filters it.
$plain = wp_doing_ajax();
add_filter( 'wp_doing_ajax', '__return_true' );
return array( $plain, wp_doing_ajax() );
