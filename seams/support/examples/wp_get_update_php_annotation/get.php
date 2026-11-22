<?php
// The note that the PHP update link comes from the host; empty when it is WordPress.org's.
$default = wp_get_update_php_annotation();
add_filter( 'wp_update_php_url', fn() => 'https://host.example/php' );
return array( $default, wp_get_update_php_annotation() );
