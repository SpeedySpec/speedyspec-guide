<?php
// Registers the edit screen's boxes for a post: Publish, Format, taxonomies, Featured image, Excerpt, Custom Fields and the others; then fires add_meta_boxes.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
set_current_screen( 'post' );
register_and_do_post_meta_boxes( $post );
return array_keys( $GLOBALS['wp_meta_boxes']['post']['side']['core'] );
