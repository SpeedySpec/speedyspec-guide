<?php
// Prints the current comment's author name for a feed.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
$GLOBALS['comment'] = get_comment( wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_author' => 'Ada', 'comment_content' => 'Lovely', 'comment_approved' => 1 ) ) );
return guide_render( 'comment_author_rss' );
