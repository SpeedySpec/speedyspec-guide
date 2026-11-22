<?php
// A value other than false from pre_transient_{$transient} is returned without reading the transient.
function guide_short_circuit_transient( $pre ) {
	return 'from the filter';
}
add_filter( 'pre_transient_guide_t', 'guide_short_circuit_transient' );
return get_transient( 'guide_t' );
