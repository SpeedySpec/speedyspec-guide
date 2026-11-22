<?php
// The theme's editor stylesheets (from add_editor_style(), when it supports editor-styles) as CSS for the editor, fetched or read from the theme.
switch_theme( 'twentytwentyfive' );
wp_set_template_globals();
add_theme_support( 'editor-styles' );
add_editor_style( 'style.css' );
$styles = get_block_editor_theme_styles();
return array( count( $styles ), $styles[0]['__unstableType'] ?? null, isset( $styles[0]['css'] ) );
