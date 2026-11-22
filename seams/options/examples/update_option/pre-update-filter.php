<?php
// pre_update_option_{$option} can change the value before it is saved.
function guide_uppercase_blogname( $value ) {
	return strtoupper( $value );
}
add_filter( 'pre_update_option_blogname', 'guide_uppercase_blogname' );
update_option( 'blogname', 'loud' );
return get_option( 'blogname' );
