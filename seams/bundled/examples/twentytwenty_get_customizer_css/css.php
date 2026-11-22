<?php
// The CSS for the colors set in the Customizer that differ from the defaults, for the front end, the block editor or the classic editor; empty when nothing differs.
guide_theme( 'twentytwenty' );
$defaults = twentytwenty_get_customizer_css();
set_theme_mod( 'accent_accessible_colors', array( 'content' => array( 'text' => '#000000', 'accent' => '#0000ff', 'secondary' => '#6d6d6d', 'borders' => '#dcd7ca' ) ) );
$css = twentytwenty_get_customizer_css( 'classic-editor' );
return array( $defaults, str_contains( $css, '#0000ff' ) );
