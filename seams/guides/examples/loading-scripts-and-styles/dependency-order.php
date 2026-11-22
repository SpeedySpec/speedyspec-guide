<?php
// Declare what a script needs, and WordPress loads it first, once, however many scripts need it.
$plugin_file = WP_PLUGIN_DIR . '/my-plugin/my-plugin.php';
wp_register_script( 'my-plugin-books', plugins_url( 'js/books.js', $plugin_file ), array(), '1.2.0', array( 'in_footer' => true ) );
wp_register_script( 'my-plugin-chart', plugins_url( 'js/chart.js', $plugin_file ), array( 'my-plugin-books', 'wp-i18n' ), '1.2.0', array( 'in_footer' => true ) );
wp_register_script( 'my-plugin-table', plugins_url( 'js/table.js', $plugin_file ), array( 'my-plugin-books' ), '1.2.0', array( 'in_footer' => true ) );

wp_enqueue_script( 'my-plugin-chart' );
wp_enqueue_script( 'my-plugin-table' );
ob_start();
wp_print_scripts();
preg_match_all( '/<script[^>]* id="([^"]+)-js"/', ob_get_clean(), $printed );
return $printed[1]; // The handles, in the order their tags were printed.
