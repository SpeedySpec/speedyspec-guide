<?php
// Ends an AJAX request for wp_die(): only the message is printed, with the status and no-cache headers.
return guide_render( fn() => _ajax_wp_die_handler( 'Nope', '', array( 'exit' => false, 'response' => 403 ) ) );
