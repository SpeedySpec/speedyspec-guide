<?php
// Rewinds the main query's Loop to its first post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( '/' );
the_post();
rewind_posts();
return array( $GLOBALS['wp_query']->current_post, have_posts() );
