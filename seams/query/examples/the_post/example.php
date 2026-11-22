<?php
// Moves the main query's Loop to its next post and sets it up as the global post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );

guide_go( '/' );
the_post();
return array( get_the_title(), $GLOBALS['post']->ID === $id, in_the_loop() );
