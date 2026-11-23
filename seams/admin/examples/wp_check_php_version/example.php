<?php
// Asks the WordPress.org Serve Happy API whether the server's PHP version is supported, secure or recommended, cached for a week.
guide_queue_http( array( array( 'recommended_version' => '8.3', 'minimum_version' => '7.4', 'is_supported' => true, 'is_secure' => true, 'is_acceptable' => true ) ) );
$check = wp_check_php_version();
return array( $check['recommended_version'], $check['is_supported'] );
