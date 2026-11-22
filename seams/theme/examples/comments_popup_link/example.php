<?php
// Prints a link to the current post's comments, or text when comments are closed or protected.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( fn() => comments_popup_link( 'Leave a comment', 'One comment', '% comments' ) );
