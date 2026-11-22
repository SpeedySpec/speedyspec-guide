<?php
// Pass data from PHP to your script with wp_add_inline_script() and wp_json_encode(), never by gluing strings together.
$plugin_file = WP_PLUGIN_DIR . '/my-plugin/my-plugin.php';
wp_register_script( 'my-plugin-books', plugins_url( 'js/books.js', $plugin_file ), array(), '1.2.0', array( 'in_footer' => true ) );

$settings = array(
	'restRoot' => esc_url_raw( rest_url( 'my-plugin/v1/' ) ),
	'greeting' => get_option( 'my_plugin_greeting', 'Say "hi" </script><script>alert(1)</script>' ),
	'perPage'  => 10,
);
wp_add_inline_script( 'my-plugin-books', 'const myPluginSettings = ' . wp_json_encode( $settings ) . ';', 'before' );

wp_enqueue_script( 'my-plugin-books' );
wp_print_scripts( array( 'my-plugin-books' ) );
return null;
