<?php
// Register once with a version, then enqueue where needed; the version in the URL makes browsers fetch each release.
define( 'MY_PLUGIN_VERSION', '1.2.0' ); // Bump it with every release.

function my_plugin_register_assets() {
	$plugin_file = WP_PLUGIN_DIR . '/my-plugin/my-plugin.php';
	wp_register_style( 'my-plugin-books', plugins_url( 'css/books.css', $plugin_file ), array(), MY_PLUGIN_VERSION );
	wp_register_script(
		'my-plugin-books',
		plugins_url( 'js/books.js', $plugin_file ),
		array(),
		MY_PLUGIN_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
}
add_action( 'init', 'my_plugin_register_assets' );
my_plugin_register_assets(); // The site has already fired init when the example runs.

wp_enqueue_style( 'my-plugin-books' );
wp_enqueue_script( 'my-plugin-books' );
wp_print_styles( array( 'my-plugin-books' ) );
wp_print_scripts( array( 'my-plugin-books' ) );
return null;
