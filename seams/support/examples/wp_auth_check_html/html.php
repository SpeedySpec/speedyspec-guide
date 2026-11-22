<?php
// Prints the hidden login dialog for when the session expires: the login form in an iframe, or a link when the login page is on another host.
$html = guide_render( 'wp_auth_check_html' );
return array( str_contains( $html, 'id="wp-auth-check-wrap"' ), str_contains( $html, 'interim-login=1' ) );
