<?php
// Prints the link to the previous or next image attached to the same post as the current image.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
$a = guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Lake', 'menu_order' => 1 ) );
$b = guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Hill', 'menu_order' => 2 ) );
$c = guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Sea', 'menu_order' => 3 ) );
$GLOBALS['post'] = get_post( $b );
return guide_render( fn() => adjacent_image_link( false, 'thumbnail', 'On' ) );
