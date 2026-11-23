<?php
// A control callback gives the widget a settings form; WordPress checks the form's nonce before calling it.
require_once ABSPATH . 'wp-admin/includes/admin.php';
require_once ABSPATH . 'wp-admin/includes/dashboard.php';

function my_plugin_render_goal_widget() {
	/* translators: %s: The yearly goal. */
	echo '<p>' . esc_html( sprintf( __( 'Goal: %s books a year.', 'my-plugin' ), number_format_i18n( (int) get_option( 'my_plugin_reading_goal', 12 ) ) ) ) . '</p>';
}

function my_plugin_goal_widget_control() {
	if ( isset( $_POST['my_plugin_reading_goal'] ) && current_user_can( 'manage_options' ) ) {
		update_option( 'my_plugin_reading_goal', absint( wp_unslash( $_POST['my_plugin_reading_goal'] ) ), false );
	}
	printf(
		'<label for="my-plugin-goal">%s</label> <input type="number" id="my-plugin-goal" name="my_plugin_reading_goal" value="%s" />',
		esc_html__( 'Books a year', 'my-plugin' ),
		esc_attr( (int) get_option( 'my_plugin_reading_goal', 12 ) )
	);
}

function my_plugin_add_goal_widget() {
	if ( current_user_can( 'edit_posts' ) ) {
		wp_add_dashboard_widget( 'my_plugin_goal', __( 'Reading goal', 'my-plugin' ), 'my_plugin_render_goal_widget', 'my_plugin_goal_widget_control' );
	}
}
add_action( 'wp_dashboard_setup', 'my_plugin_add_goal_widget' );

set_current_screen( 'dashboard' );
wp_dashboard_setup();

// The form posts its value; wp_dashboard_setup() checks the nonce, then runs this, then redirects back.
$_POST['my_plugin_reading_goal'] = '24 books';
ob_start();
wp_dashboard_trigger_widget_control( 'my_plugin_goal' );
$form = ob_get_clean();
ob_start();
my_plugin_render_goal_widget();
return array( 'saved goal' => get_option( 'my_plugin_reading_goal' ), 'form field' => preg_match( '/value="(\d+)"/', $form, $m ) ? $m[1] : null, 'widget' => ob_get_clean() );
