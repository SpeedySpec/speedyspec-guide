<?php
// The value of a post meta key for a block bound to core/post-meta: only meta shown in REST and not protected, for a post the user may read.
register_post_meta( 'post', 'subtitle', array( 'show_in_rest' => true, 'single' => true, 'type' => 'string' ) );
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'meta_input' => array( 'subtitle' => 'A tale', '_secret' => 'hidden' ) ) );
$block = new WP_Block( parse_blocks( '<!-- wp:paragraph --><p></p><!-- /wp:paragraph -->' )[0] );
$block->context = array( 'postId' => $id, 'postType' => 'post' );
return array( _block_bindings_post_meta_get_value( array( 'key' => 'subtitle' ), $block ), _block_bindings_post_meta_get_value( array( 'key' => '_secret' ), $block ) );
