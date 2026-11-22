<?php
// Rebuilds the rules and saves them once wp_loaded has fired (before, it waits for it); a soft flush doesn't write .htaccess. Here the save is caught to show it.
do_action( 'wp_loaded' );
add_filter( 'pre_option_rewrite_rules', fn() => '' );
add_action( 'delete_option', fn( $o ) => print( "delete $o\n" ) );
add_filter( 'pre_update_option_rewrite_rules', function ( $value, $old ) { echo 'update rewrite_rules: ', is_array( $value ) ? count( $value ) . ' rules' : var_export( $value, true ), "\n"; throw new RuntimeException( 'stopped before the database' ); }, 10, 2 );
guide_permalinks( '/%postname%/' );
try { flush_rewrite_rules( false ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
