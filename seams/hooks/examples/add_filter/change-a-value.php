<?php
// Change a value WordPress passes through a filter.
function guide_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'guide_excerpt_length', 999 );

return apply_filters( 'excerpt_length', 55 );
