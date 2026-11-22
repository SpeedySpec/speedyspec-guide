<?php
// Stops the Customizer with the WordPress 5.3 notice and a back link, on WordPress older than 5.3.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '5.2';
function guide_throw_die_message( $message ) {
	throw new RuntimeException( $message );
}
function guide_die_handler( $handler ) {
	return 'guide_throw_die_message';
}
add_filter( 'wp_die_handler', 'guide_die_handler' );
try { twenty_twenty_one_customize(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
