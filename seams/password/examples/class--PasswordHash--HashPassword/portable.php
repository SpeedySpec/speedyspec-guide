<?php
// phpass portable hashes, which WordPress used for passwords before 6.8: $P$ and a salt, then MD5 stretched 2^8 times (the cost given), base64 encoded; CheckPassword() checks a password against one.
require_once ABSPATH . WPINC . '/class-phpass.php';
$hasher = new PasswordHash( 8, true );
$hash = $hasher->HashPassword( 'secret' );
return array( substr( $hash, 0, 3 ), strlen( $hash ), $hasher->CheckPassword( 'secret', $hash ), $hasher->CheckPassword( 'wrong', $hash ) );
