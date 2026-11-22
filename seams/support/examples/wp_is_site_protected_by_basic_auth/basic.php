<?php
// Whether the site sits behind HTTP Basic authentication in a context (login, admin, front), seen from the request's PHP_AUTH_USER or a 401; filtered by wp_is_site_protected_by_basic_auth.
$plain = wp_is_site_protected_by_basic_auth( 'front' );
$_SERVER['PHP_AUTH_USER'] = 'ada';
return array( $plain, wp_is_site_protected_by_basic_auth( 'front' ) );
