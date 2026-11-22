<?php
// Registers and enqueues the theme stylesheet (style.min.css unless SCRIPT_DEBUG), with its path so WordPress can inline it; on wp_enqueue_scripts.
guide_theme( 'ipsum' );
ipsum_enqueue_styles();
$style = wp_styles()->registered['ipsum-style'];
return array( basename( $style->src ), wp_style_is( 'ipsum-style' ), basename( $style->extra['path'] ) );
