<?php
// Prints how many posts the author has.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'the_author_posts' );
