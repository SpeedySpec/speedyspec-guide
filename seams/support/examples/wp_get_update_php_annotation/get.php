<?php
// The note that the PHP update link comes from the host; empty when it is WordPress.org's.
$default = wp_get_update_php_annotation();
function guide_host_update_php_url( $url ) {
	return 'https://host.example/php';
}
add_filter( 'wp_update_php_url', 'guide_host_update_php_url' );
return array( $default, wp_get_update_php_annotation() );
