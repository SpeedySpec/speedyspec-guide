<?php
// Create the plugin's table on activation with dbDelta(), and remember which version of it is installed.
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
register_activation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_install_tables' );

global $wpdb;
$changes = my_plugin_install_tables();
$again   = dbDelta( my_plugin_reads_schema() ); // Running it again changes nothing.
return array(
	'created'     => array_values( $changes ),
	'run again'   => $again,
	'table'       => $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $wpdb->prefix . 'my_plugin_reads' ) ) ),
	'db version'  => get_option( 'my_plugin_db_version' ),
);
