<?php
// phpass's own base64 alphabet (./0-9A-Za-z), used for salts and hashes; crypt_private() checks a password against a $P$ or $H$ hash and gives *0 or *1 for a bad setting.
require_once ABSPATH . WPINC . '/class-phpass.php';
$hasher = new PasswordHash( 8, true );
return array( $hasher->encode64( "\x00\x01\x02", 3 ), $hasher->crypt_private( 'secret', 'nope' ) );
