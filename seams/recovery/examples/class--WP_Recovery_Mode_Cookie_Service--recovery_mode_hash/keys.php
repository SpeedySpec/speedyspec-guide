<?php
// When AUTH_KEY is a default phrase or missing, the hash uses a random key stored in the recovery_mode_auth_key site option instead (and recovery_mode_auth_salt for the salt). Here the constants are set, so no option is written.
$service = new WP_Recovery_Mode_Cookie_Service();
$hash = guide_call( $service, 'recovery_mode_hash', 'data' );
return array( $hash === hash_hmac( 'sha1', 'data', AUTH_KEY . AUTH_SALT ), get_option( 'recovery_mode_auth_key' ) );
