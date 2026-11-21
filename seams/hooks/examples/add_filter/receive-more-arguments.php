<?php
// Receive more than one argument.
add_filter( 'the_title', function ( $title, $post_id ) {
	return 42 === $post_id ? "Pinned: $title" : $title;
}, 10, 2 );

return apply_filters( 'the_title', 'Hello', 42 );
