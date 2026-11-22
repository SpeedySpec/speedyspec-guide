<?php
// The comments call to action the ipsum/comments-cta binding gives a block: a link to the comments, Join the conversation or Be the first to comment, with the title for screen readers; empty when comments are closed, null without a post.
guide_theme( 'ipsum' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'comment_status' => 'open' ) );
$block = (object) array( 'context' => array( 'postId' => $post ) );
$first = ipsum_comments_cta_binding( array(), $block );
wp_update_post( array( 'ID' => $post, 'comment_status' => 'closed' ) );
return array( $first, ipsum_comments_cta_binding( array(), $block ), ipsum_comments_cta_binding( array(), (object) array( 'context' => array() ) ) );
