<?php
// Hooked to the_content on attachment pages: puts the attachment (its image, or a player for audio and video) before the content.
$att = wp_insert_attachment( array( 'post_title' => 'Photo', 'post_mime_type' => 'image/jpeg', 'post_excerpt' => 'A caption', 'guid' => 'http://example.org/wp-content/uploads/photo.jpg' ), 'photo.jpg' );
wp_update_attachment_metadata( $att, array( 'file' => 'photo.jpg', 'width' => 800, 'height' => 600, 'sizes' => array() ) );
guide_go( "/?attachment_id=$att" );
the_post();
return str_contains( prepend_attachment( '<p>Text</p>' ), 'class="attachment"' );
