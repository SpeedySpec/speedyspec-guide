<?php
// Enqueues the theme stylesheet (with an RTL replacement) and print styles, the priority menu and touch navigation scripts when the primary menu is set, and comment-reply on single posts with threaded comments; on wp_enqueue_scripts.
guide_theme( 'twentynineteen' );
twentynineteen_scripts();
return array( wp_style_is( 'twentynineteen-style' ), wp_style_is( 'twentynineteen-print-style' ), wp_script_is( 'twentynineteen-priority-menu' ) );
