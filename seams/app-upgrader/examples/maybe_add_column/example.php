<?php
// Adds a column to a table with an ALTER TABLE statement unless it has it, and says whether it has it afterwards.
global $wpdb;
$table = $wpdb->prefix . 'guide_scores';
maybe_create_table( $table, "CREATE TABLE $table ( id bigint(20) unsigned NOT NULL, PRIMARY KEY  (id) )" );
$added = maybe_add_column( $table, 'player', "ALTER TABLE $table ADD player varchar(60) NOT NULL DEFAULT ''" );
$columns = $wpdb->get_col( "DESC $table", 0 );
$wpdb->query( "DROP TABLE $table" );
return array( $added, $columns );
