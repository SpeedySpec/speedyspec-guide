<?php
// Drops an index from a table, and any further indexes MySQL named after it.
global $wpdb;
$table = $wpdb->prefix . 'guide_scores';
maybe_create_table( $table, "CREATE TABLE $table ( id bigint(20) unsigned NOT NULL, player varchar(60) NOT NULL, PRIMARY KEY  (id), KEY player (player) )" );
drop_index( $table, 'player' );
$indexes = array_unique( $wpdb->get_col( "SHOW INDEX FROM $table", 2 ) );
$wpdb->query( "DROP TABLE $table" );
return array_values( $indexes );
