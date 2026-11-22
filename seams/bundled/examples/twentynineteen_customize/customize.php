<?php
// Stops the Customizer with the WordPress 4.7 notice and a back link, on older WordPress.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '4.6';
add_filter( 'wp_die_handler', fn() => function ( $message ) { throw new RuntimeException( $message ); } );
try { twentynineteen_customize(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
