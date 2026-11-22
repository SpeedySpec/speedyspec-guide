<?php
// The page to learn about updating PHP: WP_UPDATE_PHP_URL or wp_update_php_url, else WordPress.org's.
add_filter( 'wp_update_php_url', fn() => 'https://host.example/php' );
return wp_get_update_php_url();
