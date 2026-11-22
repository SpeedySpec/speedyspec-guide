<?php
// Enqueues the block editor styles (with RTL), the Customizer's colors and the localized fonts, and the Inter font; on enqueue_block_assets in the admin.
guide_theme( 'twentytwenty' );
twentytwenty_block_editor_styles();
return array( wp_style_is( 'twentytwenty-block-editor-styles' ), wp_style_is( 'twentytwenty-fonts' ) );
