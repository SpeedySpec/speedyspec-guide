<?php
// Halves the custom logo's width and height (and sets its height in the style) when it is a retina logo; on get_custom_logo.
guide_theme( 'twentytwenty' );
$image = wp_insert_attachment( array( 'post_title' => 'Logo', 'post_mime_type' => 'image/png' ), 'logo.png' );
wp_update_attachment_metadata( $image, array( 'width' => 400, 'height' => 200, 'file' => 'logo.png', 'sizes' => array() ) );
set_theme_mod( 'custom_logo', $image );
set_theme_mod( 'retina_logo', true );
return twentytwenty_get_custom_logo( '<img width="400" height="200" src="logo.png">' );
