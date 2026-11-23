<?php
// Add a dashboard widget on wp_dashboard_setup; its callback prints the widget's content, escaped.
require_once ABSPATH . 'wp-admin/includes/admin.php'; // Loaded on every admin screen; the example loads it itself.
require_once ABSPATH . 'wp-admin/includes/dashboard.php'; // Loaded by the dashboard screen.

function my_plugin_render_dashboard_widget() {
	$goal  = (int) get_option( 'my_plugin_reading_goal', 12 );
	$books = count( (array) get_user_meta( get_current_user_id(), 'my_plugin_reading_list', true ) );
	/* translators: 1: Books read. 2: The yearly goal. */
	echo '<p>' . esc_html( sprintf( __( 'You have read %1$s of %2$s books this year.', 'my-plugin' ), number_format_i18n( $books ), number_format_i18n( $goal ) ) ) . '</p>';
}

function my_plugin_add_dashboard_widget() {
	if ( ! current_user_can( 'edit_posts' ) ) {
		return;
	}
	wp_add_dashboard_widget( 'my_plugin_reading_stats', __( 'Reading stats', 'my-plugin' ), 'my_plugin_render_dashboard_widget' );
}
add_action( 'wp_dashboard_setup', 'my_plugin_add_dashboard_widget' );

update_user_meta( 1, 'my_plugin_reading_list', array( 'Dune', 'Emma' ) );
set_current_screen( 'dashboard' );
wp_dashboard_setup(); // What the dashboard screen does as it loads.

$box = $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core']['my_plugin_reading_stats'];
ob_start();
call_user_func( $box['callback'] );
return array( 'title' => $box['title'], 'content' => ob_get_clean() );
