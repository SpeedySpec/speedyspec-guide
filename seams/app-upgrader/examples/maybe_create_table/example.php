<?php
// Creates a table from a CREATE TABLE statement unless it exists, and says whether it exists afterwards.
global $wpdb;
$table = $wpdb->prefix . 'guide_scores';
$created = maybe_create_table( $table, "CREATE TABLE $table ( id bigint(20) unsigned NOT NULL AUTO_INCREMENT, score int NOT NULL, PRIMARY KEY  (id) )" );
$again = maybe_create_table( $table, "CREATE TABLE $table ( id bigint(20) )" );
$wpdb->query( "DROP TABLE $table" );
return array( $created, $again );
