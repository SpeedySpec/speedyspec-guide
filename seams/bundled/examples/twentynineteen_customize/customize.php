<?php
// Stops the Customizer with the WordPress 4.7 notice and a back link, on older WordPress.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '4.6';
function guide_throw_die_message( $message ) {
	throw new RuntimeException( $message );
}
function guide_die_handler( $handler ) {
	return 'guide_throw_die_message';
}
add_filter( 'wp_die_handler', 'guide_die_handler' );
try { twentynineteen_customize(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
