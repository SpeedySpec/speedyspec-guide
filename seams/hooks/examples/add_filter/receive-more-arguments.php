<?php
// Receive more than one argument.
function guide_pin_title( $title, $post_id ) {
	return 42 === $post_id ? "Pinned: $title" : $title;
}
add_filter( 'the_title', 'guide_pin_title', 10, 2 );

return apply_filters( 'the_title', 'Hello', 42 );
