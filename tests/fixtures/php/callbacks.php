<?php
add_filter( 'b', array( 'WP_Hook', 'build_preinitialized_hooks' ) );
add_action( 'c', 'Foo::bar' );
add_filter( 'd', array( $this, 'm' ) );
add_filter( 'e', fn() => 1 );
add_filter( "dyn_{$x}", 'wpautop' );
$fn();
$obj->$method();
