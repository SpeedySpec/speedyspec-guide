<?php
// The arguments array holds the value first, then the extra arguments.
function guide_append( $value, $suffix ) {
	return $value . $suffix;
}
$hook = new WP_Hook();
$hook->add_filter( 'guide', 'guide_append', 10, 2 );

return $hook->apply_filters( 'a', array( 'a', 'b' ) );
