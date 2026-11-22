<?php
// A random header image's URL, from the uploaded or default headers.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
register_default_headers( array( 'one' => array( 'url' => '%s/one.jpg', 'thumbnail_url' => '%s/one-t.jpg' ) ) );
set_theme_mod( 'header_image', 'random-default-image' );
return basename( get_random_header_image() );
