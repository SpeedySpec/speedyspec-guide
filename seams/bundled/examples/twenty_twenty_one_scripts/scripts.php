<?php
// Enqueues the theme's styles (with an RTL replacement) and print styles, comment-reply on single posts with threaded comments, the primary navigation script when that menu is set, and the responsive embeds script; on wp_enqueue_scripts.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_scripts();
return array( wp_style_is( 'twenty-twenty-one-style' ), wp_style_is( 'twenty-twenty-one-print-style' ), wp_script_is( 'twenty-twenty-one-primary-navigation-script' ), wp_script_is( 'twenty-twenty-one-responsive-embeds-script' ) );
