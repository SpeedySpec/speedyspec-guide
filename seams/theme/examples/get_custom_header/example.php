<?php
// The header image's data (URL, thumbnail, size, attachment ID), from the theme mod or its defaults.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
set_theme_mod( 'header_image', 'http://example.org/wp-content/uploads/header.jpg' );
$data = get_custom_header();
return array( $data->url, $data->width, $data->height );
