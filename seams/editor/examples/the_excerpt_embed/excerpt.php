<?php
// Prints the current post's excerpt for its embed view; the_excerpt_embed filters it.
guide_view( guide_post( array( 'post_excerpt' => 'A short summary.' ) ) );
add_filter( 'the_excerpt_embed', fn( $e ) => "<p>$e</p>" );
return guide_render( 'the_excerpt_embed' );
