<?php
// A named function is removed by its name, at the priority it was added with.
function guide_shout_text( $text ) {
	return strtoupper( $text );
}
add_filter( 'guide_text', 'guide_shout_text', 20 );
return array(
	'filtered'      => apply_filters( 'guide_text', 'hi' ),
	'removed at 10' => remove_filter( 'guide_text', 'guide_shout_text' ),
	'removed at 20' => remove_filter( 'guide_text', 'guide_shout_text', 20 ),
	'after'         => apply_filters( 'guide_text', 'hi' ),
);
