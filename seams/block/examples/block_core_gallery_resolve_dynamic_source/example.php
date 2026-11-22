<?php
// The image attachment IDs a dynamic Gallery shows, from its dynamicContent source, in order.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
$a = wp_insert_attachment( array( 'post_title' => 'A', 'post_mime_type' => 'image/jpeg', 'post_parent' => $id, 'menu_order' => 1 ), 'a.jpg' );
$b = wp_insert_attachment( array( 'post_title' => 'B', 'post_mime_type' => 'image/jpeg', 'post_parent' => $id, 'menu_order' => 2 ), 'b.jpg' );
$block = new WP_Block( parse_blocks( '<!-- wp:gallery /-->' )[0], array( 'postId' => $id ) );
$block->context = array( 'postId' => $id );
$ids = block_core_gallery_resolve_dynamic_source( array( 'source' => 'core/attached-media' ), $block );
return array( count( $ids ), array_map( 'get_the_title', $ids ) );
