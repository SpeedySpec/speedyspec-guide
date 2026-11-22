<?php
// Prints a plain error page holding a message (both filtered, by graceful_fail and graceful_fail_template) and ends the request; deprecated in 3.0.0 for wp_die(). Here the graceful_fail filter stops it first.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
add_filter( 'graceful_fail', function ( $message ) { throw new RuntimeException( "graceful_fail: $message" ); } );
try { graceful_fail( 'Something broke.' ); } catch ( RuntimeException $e ) { return $e->getMessage(); }
