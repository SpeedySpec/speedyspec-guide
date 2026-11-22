<?php
// Drops the categories, link2cat and post2cat tables WordPress 2.3 replaced with the taxonomy tables.
global $wpdb;
$wpdb->query( "CREATE TABLE {$wpdb->prefix}categories ( cat_ID int )" );
upgrade_230_old_tables();
return $wpdb->get_var( "SHOW TABLES LIKE '{$wpdb->prefix}categories'" );
