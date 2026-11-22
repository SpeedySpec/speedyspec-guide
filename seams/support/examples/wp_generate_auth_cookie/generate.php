<?php
// A login cookie for a user: login|expiration|token|HMAC, the HMAC keyed on the scheme's salt and part of the password hash.
$cookie = wp_generate_auth_cookie( 1, 2000000000, 'logged_in', 'tok' );
return array_slice( explode( '|', $cookie ), 0, 3 ) + array( 3 => strlen( explode( '|', $cookie )[3] ) );
