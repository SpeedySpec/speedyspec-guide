<?php
// Comment query arguments from a Comments block's context: the post, order, paging and threading by the discussion settings.
$id = wp_insert_post( array( 'post_title' => 'P', 'post_status' => 'publish' ) );
$vars = build_comment_query_vars_from_block( new WP_Block( array( 'blockName' => 'core/comment-template' ), array( 'postId' => $id ) ) );
return array( $vars['post_id'] === $id, $vars['order'], $vars['status'] );
