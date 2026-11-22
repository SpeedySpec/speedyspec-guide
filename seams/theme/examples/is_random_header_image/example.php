<?php
// Whether the header image is set to random, of a kind: any, default or uploaded.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
set_theme_mod( 'header_image', 'random-uploaded-image' );
return array( is_random_header_image(), is_random_header_image( 'uploaded' ), is_random_header_image( 'default' ) );
