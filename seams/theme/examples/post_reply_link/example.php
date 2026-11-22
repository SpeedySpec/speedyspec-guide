<?php
// Prints a link to reply to a post.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
return guide_render( fn() => post_reply_link( array(), $id ) );
