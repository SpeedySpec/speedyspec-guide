<?php
// Enqueues the theme stylesheet (style.min.css unless SCRIPT_DEBUG), with its path so WordPress can inline it; on wp_enqueue_scripts.
guide_theme( 'twentytwentyfive' );
twentytwentyfive_enqueue_styles();
return array( basename( wp_styles()->registered['twentytwentyfive-style']->src ), wp_style_is( 'twentytwentyfive-style' ) );
