<?php
// The value of a post field (date, modified date, link) for a block bound to core/post-data, for the post in context the user may read.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$block = new WP_Block( parse_blocks( '<!-- wp:paragraph --><p></p><!-- /wp:paragraph -->' )[0] );
$block->context = array( 'postId' => $id, 'postType' => 'post' );
return array( _block_bindings_post_data_get_value( array( 'field' => 'date' ), $block ), _block_bindings_post_data_get_value( array(), $block ) );
