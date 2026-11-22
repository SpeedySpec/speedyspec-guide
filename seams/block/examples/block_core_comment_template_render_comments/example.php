<?php
// Renders comments with the Comment Template block's inner blocks, nesting replies when threaded.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
wp_insert_comment( array( 'comment_post_ID' => $id, 'comment_content' => 'Nice post', 'comment_author' => 'Ada', 'comment_approved' => 1 ) );
$block = new WP_Block( parse_blocks( '<!-- wp:comment-template --><!-- wp:comment-content /--><!-- /wp:comment-template -->' )[0], array( 'postId' => $id ) );
return guide_render( fn() => print( block_core_comment_template_render_comments( get_comments( array( 'post_id' => $id ) ), $block ) ) );
