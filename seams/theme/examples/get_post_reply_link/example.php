<?php
// A link to reply to a post, its comment form's anchor; filtered by post_comments_link.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
return get_post_reply_link( array( 'reply_text' => 'Reply' ), $id );
