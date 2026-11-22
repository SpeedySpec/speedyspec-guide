<?php
// Renders one Image block for a dynamic Gallery, with the gallery's settings applied.
$a = wp_insert_attachment( array( 'post_title' => 'A', 'post_mime_type' => 'image/jpeg' ), 'a.jpg' );
$html = block_core_gallery_render_dynamic_image( $a, array( 'linkTo' => 'none' ), array() );
return str_contains( $html, 'wp-block-image' );
