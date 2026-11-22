<?php
// Prints {"success":false} with the data as JSON (a WP_Error becomes its codes and messages) and ends the request.
add_filter( 'wp_doing_ajax', '__return_true' );
return guide_dies( fn() => wp_send_json_error( new WP_Error( 'bad', 'Failed.' ) ) )['output'];
