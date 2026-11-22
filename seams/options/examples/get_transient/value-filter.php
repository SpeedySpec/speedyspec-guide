<?php
// transient_{$transient} filters the value read.
set_transient( 'guide_t', 'v' );
function guide_exclaim_transient( $value ) {
	return "$value!";
}
add_filter( 'transient_guide_t', 'guide_exclaim_transient' );
return get_transient( 'guide_t' );
