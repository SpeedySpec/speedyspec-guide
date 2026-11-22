<?php
// Prints a value as JSON with a JSON content type and an optional status, then ends the request (through wp_die() for AJAX requests, else die). Here the request is AJAX and the handlers throw.
add_filter( 'wp_doing_ajax', '__return_true' );
return guide_dies( fn() => wp_send_json( array( 'ok' => true ), 201 ) );
