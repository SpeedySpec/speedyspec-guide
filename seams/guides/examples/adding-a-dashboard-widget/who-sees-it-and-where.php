<?php
// Only people with the capability get the widget; a widget can sit in the side column, and others can be removed.
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

function my_plugin_tidy_dashboard() {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress Events and News.
}
add_action( 'wp_dashboard_setup', 'my_plugin_tidy_dashboard', 20 );

function guide_widgets_for( $user_id ) {
	wp_set_current_user( $user_id );
	unset( $GLOBALS['wp_meta_boxes'] );
	set_current_screen( 'dashboard' );
	wp_dashboard_setup();
	return isset( $GLOBALS['wp_meta_boxes']['dashboard']['normal']['core']['my_plugin_reading_stats'] );
}
$subscriber = wp_insert_user( array( 'user_login' => 'sam', 'user_pass' => wp_generate_password(), 'role' => 'subscriber' ) );
$admin_sees = guide_widgets_for( 1 );
$events     = $GLOBALS['wp_meta_boxes']['dashboard']['side']['core']['dashboard_primary'];
return array(
	'administrator sees it'   => $admin_sees,
	'subscriber sees it'      => guide_widgets_for( $subscriber ),
	'Events and News removed' => false === $events,
);
