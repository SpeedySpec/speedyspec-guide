<?php
// Adds the Customizer's colors to the classic editor's content_style; on tiny_mce_before_init.
guide_theme( 'twentytwenty' );
set_theme_mod( 'accent_accessible_colors', array( 'content' => array( 'text' => '#111111', 'accent' => '#0000ff', 'secondary' => '#555555', 'borders' => '#cccccc' ) ) );
$init = twentytwenty_add_classic_editor_customizer_styles( array() );
return str_contains( $init['content_style'], '#0000ff' );
