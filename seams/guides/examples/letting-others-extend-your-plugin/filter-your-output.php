<?php
// A filter on a value your plugin is about to use lets others change it; you still escape what comes back.
function my_plugin_greeting_html() {
	$text = get_option( 'my_plugin_greeting', 'Hello' );

	/**
	 * Filters the greeting My Plugin shows, before it is escaped.
	 *
	 * @param string  $text The greeting.
	 * @param WP_User $user The person it greets.
	 */
	$text = apply_filters( 'my_plugin_greeting_text', $text, wp_get_current_user() );

	return '<p class="my-plugin-greeting">' . esc_html( $text ) . '</p>';
}

function other_plugin_personal_greeting( $text, $user ) {
	return $text . ', ' . $user->display_name . ' <3';
}
add_filter( 'my_plugin_greeting_text', 'other_plugin_personal_greeting', 10, 2 );

return my_plugin_greeting_html();
