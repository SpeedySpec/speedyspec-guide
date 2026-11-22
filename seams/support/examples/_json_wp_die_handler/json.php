<?php
// Ends a JSON request for wp_die(): code, message, data (with the status) and additional errors as JSON.
return guide_render( fn() => _json_wp_die_handler( new WP_Error( 'bad', 'Failed.' ), '', array( 'exit' => false, 'response' => 400 ) ) );
