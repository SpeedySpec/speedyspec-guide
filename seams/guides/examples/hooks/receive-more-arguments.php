<?php
// Ask for more arguments with the fourth argument of add_filter(): here the post's ID along with its title.
function guide_pin_title( $title, $post_id ) {
	return 42 === $post_id ? "Pinned: $title" : $title;
}
add_filter( 'the_title', 'guide_pin_title', 10, 2 );
return apply_filters( 'the_title', 'Hello', 42 );
