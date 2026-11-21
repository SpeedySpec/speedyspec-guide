<?php
define( 'WP_FIXTURE', true );

function update_option( $option, $value ) {
	$value = apply_filters( "pre_update_option_{$option}", $value );
	$value = apply_filters( 'pre_update_option_' . $option, $value );
	$value = apply_filters( "{$meta_type}_{$args['type']}", $value );
	do_action( 'updated_option', $option );
	call_user_func( $callback );
	call_user_func( 'wpautop', $value );
	$GLOBALS['wp_options_cache'] = $value;
	return true;
}
