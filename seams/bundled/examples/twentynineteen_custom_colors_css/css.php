<?php
// The CSS that paints the theme in its primary color: the chosen hue (199 by default) with the saturation and lightness filters, for the front end and the editor; twentynineteen_custom_colors_css filters it.
guide_theme( 'twentynineteen' );
require_once get_template_directory() . '/inc/color-patterns.php';
set_theme_mod( 'primary_color', 'custom' );
set_theme_mod( 'primary_color_hue', 10 );
add_filter( 'twentynineteen_custom_colors_lightness', fn() => 40 );
$css = twentynineteen_custom_colors_css();
return array( str_contains( $css, 'hsl( 10, 100%, 40% )' ), str_contains( $css, '::selection' ) );
