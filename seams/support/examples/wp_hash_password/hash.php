<?php
// A hash of a password for storing: bcrypt with a $wp prefix (the password pre-hashed with HMAC-SHA384); wp_hash_password_algorithm and _options can change it.
$hash = wp_hash_password( 'secret' );
return array( substr( $hash, 0, 7 ), strlen( $hash ), wp_check_password( 'secret', $hash ) );
