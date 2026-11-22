<?php
// Enqueues the theme stylesheet (with an RTL replacement), the Inter font and the print styles, and adds the Customizer's colors as inline CSS; on wp_enqueue_scripts.
guide_theme( 'twentytwenty' );
set_theme_mod( 'accent_accessible_colors', array( 'content' => array( 'text' => '#111111', 'accent' => '#0000ff', 'secondary' => '#555555', 'borders' => '#cccccc' ), 'header-footer' => array( 'text' => '#000000', 'accent' => '#cd2653', 'secondary' => '#6d6d6d', 'borders' => '#dcd7ca' ) ) );
twentytwenty_register_styles();
return array( wp_style_is( 'twentytwenty-style' ), wp_style_is( 'twentytwenty-fonts' ), wp_style_is( 'twentytwenty-print-style' ), str_contains( implode( '', (array) wp_styles()->get_data( 'twentytwenty-style', 'after' ) ), '#0000ff' ) );
