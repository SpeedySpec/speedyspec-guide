<?php
// wp_spaces_regexp filters it, once: the result is kept for the request.
function guide_single_space_regexp( $spaces ) {
	return ' ';
}
add_filter( 'wp_spaces_regexp', 'guide_single_space_regexp' );
return array( wp_spaces_regexp(), remove_all_filters( 'wp_spaces_regexp' ), wp_spaces_regexp() );
