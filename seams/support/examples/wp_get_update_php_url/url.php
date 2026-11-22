<?php
// The page to learn about updating PHP: WP_UPDATE_PHP_URL or wp_update_php_url, else WordPress.org's.
function guide_host_update_php_url( $url ) {
	return 'https://host.example/php';
}
add_filter( 'wp_update_php_url', 'guide_host_update_php_url' );
return wp_get_update_php_url();
