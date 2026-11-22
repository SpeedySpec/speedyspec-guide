<?php
// Whether a header video is set: an uploaded one or an external URL.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
$before = has_header_video();
set_theme_mod( 'external_header_video', 'https://www.youtube.com/watch?v=abc' );
return array( $before, has_header_video() );
