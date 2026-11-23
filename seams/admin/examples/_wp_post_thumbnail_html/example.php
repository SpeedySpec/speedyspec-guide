<?php
// The Featured image box's HTML: the image with Replace and Remove links, or the Set featured image link; filtered by admin_post_thumbnail_html.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$html = _wp_post_thumbnail_html( null, $post );
return str_contains( $html, 'set-post-thumbnail' );
