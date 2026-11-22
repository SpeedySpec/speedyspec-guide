<?php
// A value other than false from pre_option_{$option} is returned without reading the table.
function guide_short_circuit_blogname( $pre ) {
	return 'Filtered';
}
add_filter( 'pre_option_blogname', 'guide_short_circuit_blogname' );
return get_option( 'blogname' );
