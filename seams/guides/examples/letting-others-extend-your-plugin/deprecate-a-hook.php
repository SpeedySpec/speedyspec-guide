<?php
// Renaming a hook: apply the old name through apply_filters_deprecated(), so its callbacks still run, and are warned.
function my_plugin_greeting_for_display( $text ) {
	$text = apply_filters( 'my_plugin_greeting_text', $text );

	// The old name, kept working for now.
	return apply_filters_deprecated( 'mp_greeting', array( $text ), '2.0.0', 'my_plugin_greeting_text' );
}

function old_plugin_shout( $text ) {
	return strtoupper( $text );
}
add_filter( 'mp_greeting', 'old_plugin_shout' );

// WordPress fires deprecated_hook_run when a deprecated hook with callbacks runs; debugging tools listen to it.
function my_debug_report_deprecated( $hook, $replacement, $version ) {
	echo esc_html( "$hook is deprecated since $version; use $replacement. " );
}
add_action( 'deprecated_hook_run', 'my_debug_report_deprecated', 10, 3 );

return my_plugin_greeting_for_display( 'hello' );
