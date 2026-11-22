<?php
// The host's page that updates PHP in one step: WP_DIRECT_UPDATE_PHP_URL or wp_direct_php_update_url; empty when there is none.
function guide_direct_php_update_url( $url ) {
	return 'https://host.example/update';
}
add_filter( 'wp_direct_php_update_url', 'guide_direct_php_update_url' );
return wp_get_direct_php_update_url();
