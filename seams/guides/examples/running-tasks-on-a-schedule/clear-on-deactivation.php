<?php
// Clear the event on deactivation: a deactivated plugin's event would otherwise keep firing an action nobody handles.
function my_plugin_activate() {
	if ( ! wp_next_scheduled( 'my_plugin_daily_cleanup' ) ) {
		wp_schedule_event( time(), 'daily', 'my_plugin_daily_cleanup' );
	}
}

function my_plugin_deactivate() {
	wp_clear_scheduled_hook( 'my_plugin_daily_cleanup' );
}
register_deactivation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_deactivate' );

my_plugin_activate();
$before = false !== wp_next_scheduled( 'my_plugin_daily_cleanup' );
do_action( 'deactivate_my-plugin/my-plugin.php' );
return array( 'before deactivation' => $before, 'after' => wp_next_scheduled( 'my_plugin_daily_cleanup' ) );
