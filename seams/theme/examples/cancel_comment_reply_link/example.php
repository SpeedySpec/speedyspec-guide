<?php
// Prints the link cancelling a reply.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return guide_render( 'cancel_comment_reply_link' );
