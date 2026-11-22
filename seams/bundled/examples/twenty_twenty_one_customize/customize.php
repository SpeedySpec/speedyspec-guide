<?php
// Stops the Customizer with the WordPress 5.3 notice and a back link, on WordPress older than 5.3.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/back-compat.php';
$GLOBALS['wp_version'] = '5.2';
add_filter( 'wp_die_handler', fn() => function ( $message ) { throw new RuntimeException( $message ); } );
try { twenty_twenty_one_customize(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
