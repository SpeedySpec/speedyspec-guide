<?php
// The settings the header video script needs: the video URL, size, poster, breakpoints and its labels; filtered by header_video_settings.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
set_theme_mod( 'external_header_video', 'https://www.youtube.com/watch?v=abc' );
$s = get_header_video_settings();
return array( $s['videoUrl'], $s['mimeType'], $s['width'], $s['minWidth'] );
