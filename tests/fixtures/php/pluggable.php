<?php
if ( ! function_exists( 'wp_mail' ) ) :
	function wp_mail( $to ) {
		return true;
	}
endif;

if ( ! function_exists( 'wp_mail' ) ) {
	function wp_mail( $to ) {
		return false;
	}
}
