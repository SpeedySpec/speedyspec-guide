<?php
// The GUID of a comment for a feed: its post's GUID with #comment-ID.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
return get_comment_guid( $comment ) === get_the_guid( $id ) . "#comment-$comment";
