<?php
// The plugin's uninstall.php drops its table and forgets its version, leaving nothing behind.
global $wpdb;
$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS %i', $wpdb->prefix . 'my_plugin_reads' ) ); // The example starts on a site without the table.
// The table's definition, written the way dbDelta() reads it: one column or index per line.
function my_plugin_reads_schema() {
	global $wpdb;
	$table   = $wpdb->prefix . 'my_plugin_reads';
	$collate = $wpdb->get_charset_collate();
	return "CREATE TABLE $table (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  user_id bigint(20) unsigned NOT NULL,
  book varchar(200) NOT NULL DEFAULT '',
  read_on date NOT NULL,
  PRIMARY KEY (id),
  KEY user_id (user_id)
) $collate;";
}

function my_plugin_install_tables() {
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$changes = dbDelta( my_plugin_reads_schema() );
	update_option( 'my_plugin_db_version', '1', false );
	return $changes;
}
my_plugin_install_tables();

function my_plugin_uninstall_tables() {
	global $wpdb;
	$wpdb->query( $wpdb->prepare( 'DROP TABLE IF EXISTS %i', $wpdb->prefix . 'my_plugin_reads' ) );
	delete_option( 'my_plugin_db_version' );
}
my_plugin_uninstall_tables();

global $wpdb;
return array(
	'table'      => $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $wpdb->prefix . 'my_plugin_reads' ) ) ),
	'db version' => get_option( 'my_plugin_db_version', 'gone' ),
);
