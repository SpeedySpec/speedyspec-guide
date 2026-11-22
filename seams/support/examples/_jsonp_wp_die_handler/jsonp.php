<?php
// Ends a JSONP request for wp_die(): the JSON error wrapped in the _jsonp callback.
$_GET['_jsonp'] = 'cb';
return guide_render( fn() => _jsonp_wp_die_handler( 'Failed.', '', array( 'exit' => false, 'response' => 400 ) ) );
