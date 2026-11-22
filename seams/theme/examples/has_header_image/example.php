<?php
// Whether a header image is set.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
$img = wp_insert_attachment( array( 'post_title' => 'Header', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/header.jpg' ), 'header.jpg' );
wp_update_attachment_metadata( $img, array( 'file' => 'header.jpg', 'width' => 1600, 'height' => 400, 'sizes' => array() ) );
$before = has_header_image();
set_theme_mod( 'header_image', 'http://example.org/wp-content/uploads/header.jpg' );
return array( $before, has_header_image() );
