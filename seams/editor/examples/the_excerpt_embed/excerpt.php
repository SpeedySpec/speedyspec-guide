<?php
// Prints the current post's excerpt for its embed view; the_excerpt_embed filters it.
guide_view( guide_post( array( 'post_excerpt' => 'A short summary.' ) ) );
function guide_wrap_excerpt_embed( $excerpt ) {
	return "<p>$excerpt</p>";
}
add_filter( 'the_excerpt_embed', 'guide_wrap_excerpt_embed' );
return guide_render( 'the_excerpt_embed' );
