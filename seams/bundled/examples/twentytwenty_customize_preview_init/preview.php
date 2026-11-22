<?php
// Enqueues the Customizer preview script, with the background color settings.
guide_theme( 'twentytwenty' );
twentytwenty_customize_preview_init();
return wp_script_is( 'twentytwenty-customize-preview' );
