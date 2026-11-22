<?php
// Prints the current comment's text for a feed; filtered by comment_text_rss.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
$GLOBALS['comment'] = get_comment( wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Lovely <b>tea</b> & cake', 'comment_approved' => 1 ) ) );
return guide_render( 'comment_text_rss' );
