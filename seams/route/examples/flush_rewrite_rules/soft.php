<?php
// Rebuilds the rules and saves them once wp_loaded has fired (before, it waits for it); a soft flush doesn't write .htaccess. Here the save is caught to show it.
do_action( 'wp_loaded' );
function guide_no_stored_rules() {
	return '';
}
add_filter( 'pre_option_rewrite_rules', 'guide_no_stored_rules' );
function guide_print_deleted_option( $option ) {
	print( "delete $option\n" );
}
add_action( 'delete_option', 'guide_print_deleted_option' );
function guide_stop_saving_rules( $value, $old ) {
	echo 'update rewrite_rules: ', is_array( $value ) ? count( $value ) . ' rules' : var_export( $value, true ), "\n";
	throw new RuntimeException( 'stopped before the database' );
}
add_filter( 'pre_update_option_rewrite_rules', 'guide_stop_saving_rules', 10, 2 );
guide_permalinks( '/%postname%/' );
try { flush_rewrite_rules( false ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
