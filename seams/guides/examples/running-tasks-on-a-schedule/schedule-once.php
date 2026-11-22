<?php
// Schedule a recurring event on activation; WP-Cron then runs its action about once a day.
function my_plugin_activate() {
	if ( ! wp_next_scheduled( 'my_plugin_daily_cleanup' ) ) {
		wp_schedule_event( time(), 'daily', 'my_plugin_daily_cleanup' );
	}
}
register_activation_hook( WP_PLUGIN_DIR . '/my-plugin/my-plugin.php', 'my_plugin_activate' );

do_action( 'activate_my-plugin/my-plugin.php' );
return array(
	'scheduled'  => false !== wp_next_scheduled( 'my_plugin_daily_cleanup' ),
	'recurrence' => wp_get_schedule( 'my_plugin_daily_cleanup' ),
);
