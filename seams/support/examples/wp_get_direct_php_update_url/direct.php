<?php
// The host's page that updates PHP in one step: WP_DIRECT_UPDATE_PHP_URL or wp_direct_php_update_url; empty when there is none.
add_filter( 'wp_direct_php_update_url', fn() => 'https://host.example/update' );
return wp_get_direct_php_update_url();
