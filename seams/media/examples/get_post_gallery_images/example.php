<?php
// The image URLs of the first gallery in a post's content.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish', 'post_content' => '[gallery ids="' . guide_attachment( array( 'post_title' => 'Lake' ) ) . ',' . guide_attachment( array( 'post_title' => 'Hill' ) ) . '"]<p>Words</p>[gallery ids="' . guide_attachment( array( 'post_title' => 'Sea' ) ) . '"]' ) );
return array_map( 'wp_basename', get_post_gallery_images( $post ) );
