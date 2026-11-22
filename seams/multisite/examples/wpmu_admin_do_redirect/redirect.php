<?php
// Redirects in the network admin to a URL from the request (ref or redirect) or the referer, then ends the request; deprecated in 3.3.0 for wp_redirect(). Here the redirect is stopped first.
add_action( 'deprecated_function_run', fn( $f, $r, $v ) => print( "$f is deprecated since $v" . ( $r ? " for $r" : '' ) . "\n" ), 10, 3 );
add_filter( 'wp_redirect', function ( $location ) { throw new RuntimeException( "redirect to $location" ); } );
$_GET['redirect'] = 'http://example.org/wp-admin/network/';
try { wpmu_admin_do_redirect(); } catch ( RuntimeException $e ) { return $e->getMessage(); }
