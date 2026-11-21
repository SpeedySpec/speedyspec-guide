<?php
/**
 * Fixture: a small Hook API.
 */
function add_filter( $hook_name, $callback, $priority = 10, $accepted_args = 1 ) {
	global $wp_filter;
	if ( ! isset( $wp_filter[ $hook_name ] ) ) {
		$wp_filter[ $hook_name ] = new WP_Hook();
	}
	$wp_filter[ $hook_name ]->add_filter( $hook_name, $callback, $priority, $accepted_args );
	return true;
}

function apply_filters( $hook_name, $value, ...$args ) {
	global $wp_filter;
	if ( ! isset( $wp_filter[ $hook_name ] ) ) {
		return $value;
	}
	return $wp_filter[ $hook_name ]->apply_filters( $value, $args );
}

function wpautop( $text ) {
	return $text;
}

add_filter( 'the_content', 'wpautop' );
add_filter( 'a', function () {} );
do_action( 'x_' . get_post_type() );
