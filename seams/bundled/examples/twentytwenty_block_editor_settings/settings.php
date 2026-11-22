<?php
// Gives the block editor the theme's colors (accent, primary, secondary, subtle background, background, from the Customizer) and font sizes, editor styles, and a dark editor when the text is white; on after_setup_theme.
guide_theme( 'twentytwenty' );
return array( wp_list_pluck( get_theme_support( 'editor-color-palette' )[0], 'color', 'slug' ), wp_list_pluck( get_theme_support( 'editor-font-sizes' )[0], 'size', 'slug' ) );
