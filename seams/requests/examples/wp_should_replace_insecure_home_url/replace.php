<?php
// Only for a site using HTTPS whose https_migration_required option is set (and home and site share a host); wp_should_replace_insecure_home_url filters it. wp_replace_insecure_home_url() then rewrites http home URLs, escaped or not.
add_filter( 'pre_option_home', fn() => 'https://example.org', 20 );
add_filter( 'pre_option_siteurl', fn() => 'https://example.org', 20 );
add_filter( 'pre_option_https_migration_required', fn() => '1' );
$content = 'See http://example.org/a and http:\\/\\/example.org\\/b';
return array( wp_should_replace_insecure_home_url(), wp_replace_insecure_home_url( $content ) );
