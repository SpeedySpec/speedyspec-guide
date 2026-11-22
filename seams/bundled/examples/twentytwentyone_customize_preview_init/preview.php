<?php
// Enqueues the Customizer preview scripts; on customize_preview_init.
guide_theme( 'twentytwentyone' );
twentytwentyone_customize_preview_init();
return array( wp_script_is( 'twentytwentyone-customize-helpers' ), wp_script_is( 'twentytwentyone-customize-preview' ) );
