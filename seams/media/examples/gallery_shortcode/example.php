<?php
// Renders the [gallery] shortcode: the images given by ids, or attached to the post, as a grid of linked thumbnails with captions; post_gallery can replace it.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$a = guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Lake', 'menu_order' => 1 ) );
$b = guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Hill', 'menu_order' => 2 ) );
$html = do_shortcode( "[gallery id=\"$post\" columns=\"2\" size=\"thumbnail\"]" );
return array( substr_count( $html, "class='gallery-item'" ), str_contains( $html, 'gallery-columns-2' ) );
