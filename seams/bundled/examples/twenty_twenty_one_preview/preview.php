<?php
// Stops theme previews (a preview query argument) with the WordPress 5.3 notice, on WordPress older than 5.3; back-compat.php is loaded only there.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '5.2';
$plain = twenty_twenty_one_preview();
$_GET['preview'] = 1;
function guide_throw_die_message( $message ) {
	throw new RuntimeException( $message );
}
function guide_die_handler( $handler ) {
	return 'guide_throw_die_message';
}
add_filter( 'wp_die_handler', 'guide_die_handler' );
try { twenty_twenty_one_preview(); } catch ( RuntimeException $e ) { return array( $plain, $e->getMessage() ); }
