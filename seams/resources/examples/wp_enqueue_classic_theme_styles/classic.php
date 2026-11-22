<?php
// Queues classic-theme-styles, the basic block styles, for themes without theme.json.
wp_enqueue_classic_theme_styles();
$classic = wp_style_is( 'classic-theme-styles' );
wp_dequeue_style( 'classic-theme-styles' );
guide_theme( 'twentytwentyfive' );
wp_enqueue_classic_theme_styles();
return array( $classic, wp_style_is( 'classic-theme-styles' ) );
