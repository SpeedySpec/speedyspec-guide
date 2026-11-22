<?php
// default_option_{$option} supplies the value of an option that isn't stored.
function guide_default_size( $default_value ) {
	return 'medium';
}
add_filter( 'default_option_guide_size', 'guide_default_size' );
return get_option( 'guide_size' );
