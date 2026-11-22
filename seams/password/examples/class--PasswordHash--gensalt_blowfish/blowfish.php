<?php
// Not portable, phpass hashes with bcrypt ($2a$) when PHP has it; the salt carries the cost. Passwords longer than 4096 bytes are refused with *.
require_once ABSPATH . WPINC . '/class-phpass.php';
$hasher = new PasswordHash( 8, false );
$hash = $hasher->HashPassword( 'secret' );
return array( substr( $hash, 0, 7 ), $hasher->CheckPassword( 'secret', $hash ), strlen( $hasher->HashPassword( str_repeat( 'x', 5000 ) ) ) );
