<?php
// Prints the custom colors in a custom-theme-colors style element in the head when a custom primary color is chosen (always in the Customizer preview); nothing in the admin. On wp_head.
guide_theme( 'twentynineteen' );
$default = guide_render( 'twentynineteen_colors_css_wrap' );
set_theme_mod( 'primary_color', 'custom' );
set_theme_mod( 'primary_color_hue', 10 );
$html = guide_render( 'twentynineteen_colors_css_wrap' );
return array( $default, str_starts_with( $html, '<style id="custom-theme-colors"' ), str_contains( $html, 'hsl( 10,' ) );
