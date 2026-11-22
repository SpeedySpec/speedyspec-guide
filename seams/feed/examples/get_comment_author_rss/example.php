<?php
// The current comment's author name for a feed; filtered by comment_author_rss.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
$GLOBALS['comment'] = get_comment( wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_author' => 'Ada & Co', 'comment_content' => 'Lovely', 'comment_approved' => 1 ) ) );
return get_comment_author_rss();
