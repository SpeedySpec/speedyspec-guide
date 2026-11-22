<?php
// Enqueues the theme's index.js, deferred, and comment-reply on single posts with threaded comments; on wp_enqueue_scripts.
guide_theme( 'twentytwenty' );
twentytwenty_register_scripts();
return array( wp_script_is( 'twentytwenty-js' ), wp_scripts()->get_data( 'twentytwenty-js', 'strategy' ) );
