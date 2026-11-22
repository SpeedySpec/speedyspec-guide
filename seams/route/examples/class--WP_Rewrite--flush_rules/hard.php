<?php
// Before wp_loaded it waits for it; then it rebuilds and saves the rules, and a hard flush also writes .htaccess and web.config when their savers are loaded (flush_rewrite_rules_hard can make it soft). Here the save is caught.
$early = new WP_Rewrite();
$early->flush_rules();
echo 'waits for wp_loaded: ', var_export( (bool) has_action( 'wp_loaded', array( $early, 'flush_rules' ) ), true ), "\n";
remove_all_actions( 'wp_loaded' );
do_action( 'wp_loaded' );
$r = guide_permalinks( '/%postname%/' );
function guide_no_stored_rules() {
	return '';
}
add_filter( 'pre_option_rewrite_rules', 'guide_no_stored_rules' );
function guide_report_hard_flush( $hard ) {
	print( 'hard: ' . var_export( $hard, true ) . "\n" );
	return false;
}
add_filter( 'flush_rewrite_rules_hard', 'guide_report_hard_flush' );
function guide_print_deleted_option( $option ) {
	print( "delete $option\n" );
}
add_action( 'delete_option', 'guide_print_deleted_option' );
function guide_stop_saving_rules( $value ) {
	throw new RuntimeException( 'saving ' . count( $value ) . ' rules' );
}
add_filter( 'pre_update_option_rewrite_rules', 'guide_stop_saving_rules' );
try { $r->flush_rules(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
