<?php
// To change the table later, change its definition and run dbDelta() again from an upgrade check.
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
my_plugin_install_tables(); // Version 1, as the plugin's first release left it.

// Version 2 adds a rating column.
function my_plugin_reads_schema_v2() {
	return str_replace( "  read_on date NOT NULL,\n", "  read_on date NOT NULL,\n  rating tinyint(3) unsigned NOT NULL DEFAULT 0,\n", my_plugin_reads_schema() );
}

function my_plugin_upgrade_tables() {
	if ( version_compare( get_option( 'my_plugin_db_version', '0' ), '2', '>=' ) ) {
		return array();
	}
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$changes = dbDelta( my_plugin_reads_schema_v2() );
	update_option( 'my_plugin_db_version', '2', false );
	return $changes;
}
add_action( 'plugins_loaded', 'my_plugin_upgrade_tables' ); // Checked on every request, cheaply.

global $wpdb;
$first  = my_plugin_upgrade_tables();
$second = my_plugin_upgrade_tables();
return array(
	'first check'  => array_values( $first ),
	'second check' => $second,
	'columns'      => $wpdb->get_col( 'DESCRIBE ' . $wpdb->prefix . 'my_plugin_reads' ),
);
