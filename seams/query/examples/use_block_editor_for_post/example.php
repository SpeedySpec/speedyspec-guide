<?php
// Whether a post is edited in the block editor: its type allows it and it isn't the posts page; filtered by use_block_editor_for_post.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return use_block_editor_for_post( $id );
