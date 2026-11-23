<?php
// Prints the notice that the server's PHP is outdated or insecure, from the Serve Happy check.
guide_queue_http( array( array( 'recommended_version' => '8.3', 'minimum_version' => '7.4', 'is_supported' => false, 'is_secure' => false, 'is_acceptable' => false ) ) );
return str_contains( guide_render( 'wp_dashboard_php_nag' ), 'PHP' );
