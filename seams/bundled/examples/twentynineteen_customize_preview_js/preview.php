<?php
// Enqueues the Customizer preview script; on customize_preview_init.
guide_theme( 'twentynineteen' );
twentynineteen_customize_preview_js();
return wp_script_is( 'twentynineteen-customize-preview' );
