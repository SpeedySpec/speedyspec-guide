<?php
// Saves a theme's Additional CSS (and preprocessed source) to its custom_css post, creating it when needed; filtered by update_custom_css_data.
$post = wp_update_custom_css_post( 'h1 { font-size: 2em; }', array( 'preprocessed' => '$big: 2em; h1 { font-size: $big; }' ) );
return array( $post->post_content, $post->post_content_filtered, get_theme_mod( 'custom_css_post_id' ) === $post->ID );
