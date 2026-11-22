<?php
// A value other than false from pre_option_{$option} is returned without reading the database.
function guide_force_blogname( $pre ) {
	return 'Forced title';
}
add_filter( 'pre_option_blogname', 'guide_force_blogname' );
return get_option( 'blogname' );
