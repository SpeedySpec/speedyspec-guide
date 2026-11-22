<?php
// Your plugin fires its own action when something happens, so other code can react without editing yours.
function my_plugin_save_greeting( $greeting ) {
	$old = get_option( 'my_plugin_greeting', 'nothing' );
	update_option( 'my_plugin_greeting', $greeting );

	/**
	 * Fires after My Plugin saves a new greeting.
	 *
	 * @param string $old The greeting before the change.
	 * @param string $new The greeting now saved.
	 */
	do_action( 'my_plugin_greeting_saved', $old, $greeting );
}

// Another plugin, elsewhere, listens with a named function of its own.
function other_plugin_log_greeting( $old, $new ) {
	echo esc_html( "Greeting changed from $old to $new. " );
}
add_action( 'my_plugin_greeting_saved', 'other_plugin_log_greeting', 10, 2 );

my_plugin_save_greeting( 'Hello' );
my_plugin_save_greeting( 'Howdy' );
return null;
