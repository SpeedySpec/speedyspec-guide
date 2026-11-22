<?php
// Whether application passwords can be used: supported, unless wp_is_application_passwords_available turns them off.
$default = wp_is_application_passwords_available();
add_filter( 'wp_is_application_passwords_available', '__return_true' );
return array( $default, wp_is_application_passwords_available() );
