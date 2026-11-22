<?php
// Whether a post has a featured image; filtered by has_post_thumbnail.
$id = wp_insert_post( array( 'post_title' => 'Pictured', 'post_status' => 'publish' ) );
$att = wp_insert_attachment( array( 'post_title' => 'Photo', 'post_mime_type' => 'image/jpeg', 'post_excerpt' => 'A caption', 'guid' => 'http://example.org/wp-content/uploads/photo.jpg' ), 'photo.jpg' );
wp_update_attachment_metadata( $att, array( 'file' => 'photo.jpg', 'width' => 800, 'height' => 600, 'sizes' => array() ) );
set_post_thumbnail( $id, $att );
guide_go( "/?p=$id" );
the_post();
return array( has_post_thumbnail(), has_post_thumbnail( wp_insert_post( array( 'post_title' => 'Plain' ) ) ) );
