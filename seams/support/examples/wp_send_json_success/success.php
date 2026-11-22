<?php
// Prints {"success":true} with the data given as JSON and ends the request.
add_filter( 'wp_doing_ajax', '__return_true' );
return guide_dies( fn() => wp_send_json_success( array( 'id' => 7 ) ) )['output'];
