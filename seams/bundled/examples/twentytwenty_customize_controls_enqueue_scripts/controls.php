<?php
// Enqueues the Customizer scripts that keep the accent colors accessible, with the background color settings.
guide_theme( 'twentytwenty' );
twentytwenty_customize_controls_enqueue_scripts();
return array( wp_script_is( 'twentytwenty-customize' ), wp_script_is( 'twentytwenty-color-calculations' ), wp_script_is( 'twentytwenty-customize-controls' ) );
