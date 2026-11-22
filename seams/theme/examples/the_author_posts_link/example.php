<?php
// Prints a link to the post author's archive.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'the_author_posts_link' );
