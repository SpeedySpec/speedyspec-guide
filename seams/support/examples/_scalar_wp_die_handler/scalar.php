<?php
// Ends a request for wp_die() by printing the message when it is a number or string, and exiting with it.
return guide_render( fn() => _scalar_wp_die_handler( 'Stopped', '', array( 'exit' => false ) ) );
