<?php
// Enqueues the Customizer helper script for the controls; on customize_controls_enqueue_scripts.
guide_theme( 'twentytwentyone' );
twentytwentyone_customize_controls_enqueue_scripts();
return wp_script_is( 'twentytwentyone-customize-helpers' );
