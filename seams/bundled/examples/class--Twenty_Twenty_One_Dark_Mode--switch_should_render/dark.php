<?php
// The theme's dark mode: when the site respects visitors' color preferences and its background is light, it loads the dark styles, adds the respect-color-scheme-preference class and prints the Dark Mode switch. The theme makes one when it loads.
guide_theme( 'twentytwentyone' );
$mode = new Twenty_Twenty_One_Dark_Mode();
$off = $mode->switch_should_render();
set_theme_mod( 'respect_user_color_preference', true );
$html = guide_render( array( $mode, 'the_html' ) );
return array( $off, $mode->switch_should_render(), $mode->html_classes( '' ), str_contains( $html, 'id="dark-mode-toggler"' ) );
