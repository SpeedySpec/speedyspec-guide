<?php
// Enqueues the editor's Customizer styles, with the custom colors when a custom primary color is chosen; on enqueue_block_editor_assets.
guide_theme( 'twentynineteen' );
set_theme_mod( 'primary_color', 'custom' );
set_theme_mod( 'primary_color_hue', 10 );
twentynineteen_editor_customizer_styles();
return array( wp_style_is( 'twentynineteen-editor-customizer-styles' ), str_contains( implode( '', (array) wp_styles()->get_data( 'twentynineteen-editor-customizer-styles', 'after' ) ), 'hsl( 10,' ) );
