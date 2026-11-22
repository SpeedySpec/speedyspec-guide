<?php
// Prints the post's thumbnail with its caption on single posts, or linked to the post in lists; nothing when it can't be shown.
guide_theme( 'twentytwentyone' );
$post = wp_insert_post( array( 'post_title' => 'Hello', 'post_content' => 'Body', 'post_status' => 'publish', 'post_date' => '2026-03-01 09:00:00' ) );
$image = wp_insert_attachment( array( 'post_title' => 'Photo', 'post_mime_type' => 'image/jpeg', 'post_excerpt' => 'A caption' ), 'photo.jpg', $post );
wp_update_attachment_metadata( $image, array( 'width' => 800, 'height' => 600, 'file' => 'photo.jpg', 'sizes' => array() ) );
set_post_thumbnail( $post, $image );
$GLOBALS['wp_query'] = new WP_Query( array( 'p' => $post ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
the_post();
$html = guide_render( 'twenty_twenty_one_post_thumbnail' );
return array( str_contains( $html, '<figure class="post-thumbnail">' ), str_contains( $html, 'A caption' ), str_contains( $html, 'max-width:800px' ) );
