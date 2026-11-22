<?php
// A closure added directly can't be removed: a second closure with the same code is a different callback.
add_filter( 'guide_text', function ( $text ) {
	return strtoupper( $text );
} );
$removed = remove_filter( 'guide_text', function ( $text ) {
	return strtoupper( $text );
} );
return array( $removed, apply_filters( 'guide_text', 'still shouting' ) );
