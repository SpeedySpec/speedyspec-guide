<?php
// A filter callback receives the value and returns it, changed or not.
function guide_short_excerpts( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'guide_short_excerpts', 999 );
return apply_filters( 'excerpt_length', 55 );
