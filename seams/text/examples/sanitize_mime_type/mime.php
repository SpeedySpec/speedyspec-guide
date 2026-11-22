<?php
// Keeps letters, digits and - + * . /; sanitize_mime_type gets the result and the original.
function guide_join_mime_types( $s, $m ) {
	return "$s|$m";
}
add_filter( 'sanitize_mime_type', 'guide_join_mime_types', 10, 2 );
return sanitize_mime_type( 'image/png; x="1"' );
