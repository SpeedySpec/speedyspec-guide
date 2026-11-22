<?php
// default_site_option_{$option} supplies the value of a network option that isn't stored.
function guide_default_size( $default_value ) {
	return 'medium';
}
add_filter( 'default_site_option_guide_size', 'guide_default_size' );
return get_network_option( 1, 'guide_size' );
