<?php
// Brings tables in line with CREATE TABLE statements: creates missing tables and adds or changes columns and indexes, never dropping any; gives what it did. dbdelta_queries, dbdelta_create_queries and dbdelta_insert_queries filter it.
global $wpdb;
$table = $wpdb->prefix . 'guide_scores';
$charset = $wpdb->get_charset_collate();
$first = dbDelta( "CREATE TABLE $table (\n  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,\n  score int NOT NULL,\n  PRIMARY KEY  (id)\n) $charset;" );
$second = dbDelta( "CREATE TABLE $table (\n  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,\n  score int NOT NULL,\n  player varchar(60) NOT NULL DEFAULT '',\n  PRIMARY KEY  (id),\n  KEY player (player)\n) $charset;" );
$wpdb->query( "DROP TABLE $table" );
return array( array_values( $first ), array_values( $second ) );
