<?php
// The filter can remove values, but a value it adds is dropped.
function guide_autoload_values( $values ) {
	return array( 'on', 'extra' );
}
add_filter( 'wp_autoload_values_to_autoload', 'guide_autoload_values' );
return wp_autoload_values_to_autoload();
