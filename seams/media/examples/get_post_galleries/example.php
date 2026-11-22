<?php
// The galleries in a post's content, as HTML or as their attributes and image URLs, in order; filtered by get_post_galleries.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish', 'post_content' => '[gallery ids="' . guide_attachment( array( 'post_title' => 'Lake' ) ) . ',' . guide_attachment( array( 'post_title' => 'Hill' ) ) . '"]<p>Words</p>[gallery ids="' . guide_attachment( array( 'post_title' => 'Sea' ) ) . '"]' ) );
$galleries = get_post_galleries( $post, false );
return array( count( $galleries ), count( $galleries[0]['src'] ), count( get_post_galleries( $post ) ) );
