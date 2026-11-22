<?php
// Enqueues the Customizer controls script; on customize_controls_enqueue_scripts.
guide_theme( 'twentynineteen' );
twentynineteen_panels_js();
return wp_script_is( 'twentynineteen-customize-controls' );
