<?php
// Read and write rows through $wpdb's helpers and prepare(), with a format for every value.
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

function my_plugin_log_read( $user_id, $book, $date ) {
	global $wpdb;
	$wpdb->insert(
		$wpdb->prefix . 'my_plugin_reads',
		array( 'user_id' => $user_id, 'book' => sanitize_text_field( $book ), 'read_on' => $date ),
		array( '%d', '%s', '%s' )
	);
	return (int) $wpdb->insert_id;
}

function my_plugin_reads_by( $user_id ) {
	global $wpdb;
	return $wpdb->get_col(
		$wpdb->prepare( "SELECT book FROM %i WHERE user_id = %d ORDER BY read_on", $wpdb->prefix . 'my_plugin_reads', $user_id )
	);
}

my_plugin_log_read( 1, 'Dune', '2026-01-10' );
$emma = my_plugin_log_read( 1, "Emma <script>x</script>", '2026-02-01' );
my_plugin_log_read( 2, 'Ivanhoe', '2026-01-20' );

global $wpdb;
$wpdb->update( $wpdb->prefix . 'my_plugin_reads', array( 'read_on' => '2025-12-31' ), array( 'id' => $emma ), array( '%s' ), array( '%d' ) );
$deleted = $wpdb->delete( $wpdb->prefix . 'my_plugin_reads', array( 'user_id' => 2 ), array( '%d' ) );
return array( 'user 1 reads' => my_plugin_reads_by( 1 ), 'rows deleted' => $deleted, 'user 2 reads' => my_plugin_reads_by( 2 ) );
