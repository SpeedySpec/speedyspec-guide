<?php
// Runs the changes WordPress 1.0.1 made to stored data, for a site whose database is older; upgrade_all() calls it by database version.
global $wpdb;
// A current database lacks the 1.0 columns it indexes, so its errors are hidden.
$suppressed = $wpdb->suppress_errors( true );
$before = get_option( 'db_version' );
upgrade_101();
$wpdb->suppress_errors( $suppressed );
return get_option( 'db_version' ) === $before;
