<?php
// Enqueues the theme stylesheet (style.min.css unless SCRIPT_DEBUG) with the theme's version; on wp_enqueue_scripts.
guide_theme( 'twentytwentytwo' );
twentytwentytwo_styles();
return array( basename( wp_styles()->registered['twentytwentytwo-style']->src ), wp_style_is( 'twentytwentytwo-style' ) );
