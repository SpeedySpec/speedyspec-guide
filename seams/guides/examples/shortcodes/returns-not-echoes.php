<?php
// A shortcode's function returns its HTML; WordPress puts it where the shortcode was written.
function my_plugin_greeting_shortcode() {
	return '<strong>' . esc_html__( 'Hello!', 'my-plugin' ) . '</strong>';
}

function my_plugin_echoing_shortcode() { // Don't do this: echoed output lands before the content, not in it.
	echo '<strong>' . esc_html__( 'Hello!', 'my-plugin' ) . '</strong>';
	return '';
}

function my_plugin_register_shortcodes() {
	add_shortcode( 'my_plugin_greeting', 'my_plugin_greeting_shortcode' );
	add_shortcode( 'my_plugin_echoing', 'my_plugin_echoing_shortcode' );
}
add_action( 'init', 'my_plugin_register_shortcodes' );
my_plugin_register_shortcodes(); // The site has already fired init when the example runs.

ob_start();
$returned = do_shortcode( 'Before [my_plugin_greeting] after.' );
$echoed   = do_shortcode( 'Before [my_plugin_echoing] after.' );
return array( 'returned' => $returned, 'echoed, printed early' => ob_get_clean(), 'echoed, in place' => $echoed );
