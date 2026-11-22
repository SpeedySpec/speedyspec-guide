<?php
// Stops theme previews (a preview query argument) with the WordPress 4.7 notice, on older WordPress.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '4.6';
$plain = twentynineteen_preview();
$_GET['preview'] = 1;
function guide_throw_die_message( $message ) {
	throw new RuntimeException( $message );
}
function guide_die_handler( $handler ) {
	return 'guide_throw_die_message';
}
add_filter( 'wp_die_handler', 'guide_die_handler' );
try { twentynineteen_preview(); } catch ( RuntimeException $e ) { return array( $plain, $e->getMessage() ); }
