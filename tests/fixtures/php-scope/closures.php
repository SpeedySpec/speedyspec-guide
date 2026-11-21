<?php
function a() {
	add_filter( 'x', function () {
		global $wpdb;
		$wpdb = 1;
		return b();
	} );
	$wpdb = 2;
	return array_map( fn( $v ) => c( $v ), array() );
}

function b() {
	return a();
}
