<?php
// The link cancelling a reply, hidden unless replying; filtered by cancel_comment_reply_link.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
return get_cancel_comment_reply_link( 'Cancel' );
