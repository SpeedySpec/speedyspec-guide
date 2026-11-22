<?php
// Logs out by expiring every login cookie, fired as clear_auth_cookie; send_auth_cookies can stop the sending.
add_action( 'clear_auth_cookie', fn() => print( "clear_auth_cookie\n" ) );
add_filter( 'send_auth_cookies', '__return_false' );
wp_clear_auth_cookie();
return 'cleared';
