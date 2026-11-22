<?php
// Prints the GUID of a comment for a feed.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
$comment = wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Lovely', 'comment_approved' => 1 ) );
return guide_render( fn() => comment_guid( $comment ) );
