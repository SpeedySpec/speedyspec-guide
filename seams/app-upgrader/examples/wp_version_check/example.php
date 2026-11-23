<?php
// Asks WordPress.org for core updates, sending the site's versions and statistics, and stores the answer in the update_core transient, at most twice a day unless forced.
guide_queue_http( array( array( 'offers' => array( array( 'response' => 'upgrade', 'version' => '7.3', 'current' => '7.3', 'locale' => 'en_US', 'download' => 'https://downloads.wordpress.org/release/wordpress-7.3.zip', 'packages' => array( 'full' => 'https://downloads.wordpress.org/release/wordpress-7.3.zip' ), 'php_version' => '7.4', 'mysql_version' => '5.5.5', 'new_bundled' => '6.7', 'partial_version' => '' ) ), 'translations' => array() ) ) );
// The query string lists this server's PHP, database and extensions, so only the address is shown.
ob_start();
wp_version_check( array(), true );
echo strtok( ob_get_clean(), '?' ), "\n";
$updates = get_site_transient( 'update_core' )->updates;
return array( $updates[0]->response, $updates[0]->current );
