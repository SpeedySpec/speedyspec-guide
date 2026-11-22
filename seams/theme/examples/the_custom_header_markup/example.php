<?php
// Prints the header markup and, when a video is active, enqueues the header video script with its settings.
$GLOBALS['_wp_theme_features']['custom-header'] = array( array( 'default-image' => '', 'width' => 1600, 'height' => 400, 'header-text' => true, 'default-text-color' => '333333', 'random-default' => false, 'video' => true, 'video-active-callback' => '__return_true', 'uploads' => true, 'flex-width' => false, 'flex-height' => false, 'wp-head-callback' => '', 'admin-head-callback' => '', 'admin-preview-callback' => '' ) );
set_theme_mod( 'external_header_video', 'https://www.youtube.com/watch?v=abc' );
guide_render( 'the_custom_header_markup' );
return wp_script_is( 'wp-custom-header', 'enqueued' );
