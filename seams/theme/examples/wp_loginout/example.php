<?php
// Prints a log in or log out link for the visitor; filtered by loginout.
$in = guide_render( 'wp_loginout' );
wp_set_current_user( 0 );
return array( str_contains( $in, 'action=logout' ), guide_render( fn() => wp_loginout( '/back' ) ) );
