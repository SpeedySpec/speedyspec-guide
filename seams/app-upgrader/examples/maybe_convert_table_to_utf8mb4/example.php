<?php
// Converts a table to utf8mb4 when all its text columns are utf8 or utf8mb4, and says whether it did.
global $wpdb;
$table = $wpdb->prefix . 'guide_scores';
$wpdb->query( "CREATE TABLE $table ( id int NOT NULL, player varchar(60) NOT NULL ) DEFAULT CHARACTER SET utf8mb3" );
$converted = maybe_convert_table_to_utf8mb4( $table );
$charset = $wpdb->get_var( "SELECT CHARACTER_SET_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '$table' AND COLUMN_NAME = 'player'" );
$wpdb->query( "DROP TABLE $table" );
return array( $converted, $charset );
