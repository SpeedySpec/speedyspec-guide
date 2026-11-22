<?php
// The first gallery in a post's content, as HTML or as its attributes and image URLs; filtered by get_post_gallery.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish', 'post_content' => '[gallery ids="' . guide_attachment( array( 'post_title' => 'Lake' ) ) . ',' . guide_attachment( array( 'post_title' => 'Hill' ) ) . '"]<p>Words</p>[gallery ids="' . guide_attachment( array( 'post_title' => 'Sea' ) ) . '"]' ) );
$gallery = get_post_gallery( $post, false );
return array( count( $gallery['src'] ), str_contains( get_post_gallery( $post ), 'gallery' ) );
