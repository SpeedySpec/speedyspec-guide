<?php
// Whether a secret matches a hash made by wp_fast_hash(); hashes without its $generic$ prefix are checked as old phpass hashes.
require_once ABSPATH . WPINC . '/class-phpass.php';
$hash = wp_fast_hash( 'token' );
return array( wp_verify_fast_hash( 'token', $hash ), wp_verify_fast_hash( 'other', $hash ), wp_verify_fast_hash( 'token', ( new PasswordHash( 8, true ) )->HashPassword( 'token' ) ) );
