<?php
// Stores the uninstall callback by plugin basename in the uninstall_plugins option, writing only when it changed. An object's method is refused, since it can't be stored.
function guide_report_doing_it_wrong( $function_name ) {
	print( "doing_it_wrong_run $function_name\n" );
}
add_action( 'doing_it_wrong_run', 'guide_report_doing_it_wrong' );
add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
register_uninstall_hook( WP_PLUGIN_DIR . '/shop/shop.php', 'guide_uninstall' );
register_uninstall_hook( WP_PLUGIN_DIR . '/payments/payments.php', array( 'Guide_Payments', 'uninstall' ) );
register_uninstall_hook( WP_PLUGIN_DIR . '/reports/reports.php', array( new ArrayObject(), 'count' ) );
return get_option( 'uninstall_plugins' );
