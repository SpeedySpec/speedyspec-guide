<?php
// The link attributes of one image in a dynamic Gallery, from the gallery's linkTo setting.
$a = wp_insert_attachment( array( 'post_title' => 'A', 'post_mime_type' => 'image/jpeg' ), 'a.jpg' );
return array( block_core_gallery_dynamic_image_link_attributes( $a, array( 'linkTo' => 'lightbox' ) ), array_keys( block_core_gallery_dynamic_image_link_attributes( $a, array( 'linkTo' => 'media', 'linkTarget' => '_blank' ) ) ) );
