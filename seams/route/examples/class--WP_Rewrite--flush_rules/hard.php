<?php
// Before wp_loaded it waits for it; then it rebuilds and saves the rules, and a hard flush also writes .htaccess and web.config when their savers are loaded (flush_rewrite_rules_hard can make it soft). Here the save is caught.
$early = new WP_Rewrite();
$early->flush_rules();
echo 'waits for wp_loaded: ', var_export( (bool) has_action( 'wp_loaded', array( $early, 'flush_rules' ) ), true ), "\n";
remove_all_actions( 'wp_loaded' );
do_action( 'wp_loaded' );
$r = guide_permalinks( '/%postname%/' );
add_filter( 'pre_option_rewrite_rules', fn() => '' );
add_filter( 'flush_rewrite_rules_hard', fn( $hard ) => print( 'hard: ' . var_export( $hard, true ) . "\n" ) && false );
add_action( 'delete_option', fn( $o ) => print( "delete $o\n" ) );
add_filter( 'pre_update_option_rewrite_rules', function ( $value ) { throw new RuntimeException( 'saving ' . count( $value ) . ' rules' ); } );
try { $r->flush_rules(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
