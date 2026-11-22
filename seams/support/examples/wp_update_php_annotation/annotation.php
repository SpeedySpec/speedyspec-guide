<?php
// Prints (or gives) a note, between the markup given, that the PHP update link comes from the host, when it isn't WordPress.org's.
function guide_host_update_php_url( $url ) {
	return 'https://host.example/php';
}
add_filter( 'wp_update_php_url', 'guide_host_update_php_url' );
return wp_update_php_annotation( '<p>', '</p>', false );
