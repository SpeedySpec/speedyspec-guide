<?php
// The header image URL (a random one when set to random), false when removed; filtered by theme_mod_header_image.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
set_theme_mod( 'header_image', 'http://example.org/wp-content/uploads/header.jpg' );
$set = get_header_image();
set_theme_mod( 'header_image', 'remove-header' );
return array( $set, get_header_image() );
