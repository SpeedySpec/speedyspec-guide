<?php
// pre_ent2ncr can answer instead: any value but null is returned as it is.
function guide_uppercase_text( $r, $text ) {
	return strtoupper( $text );
}
add_filter( 'pre_ent2ncr', 'guide_uppercase_text', 10, 2 );
return ent2ncr( '&copy;' );
