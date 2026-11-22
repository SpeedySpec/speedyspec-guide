<?php
// Adds the outline style of Button blocks, button-outline.css, as a stylesheet loaded only when a Button block is shown; on init.
guide_theme( 'twentytwentyfour' );
twentytwentyfour_block_stylesheets();
$before = wp_style_is( 'twentytwentyfour-button-style-outline', 'registered' );
do_action( 'enqueue_block_assets' );
do_blocks( '<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link">Go</a></div><!-- /wp:button -->' );
do_action( 'wp_enqueue_scripts' );
$style = wp_styles()->registered['twentytwentyfour-button-style-outline'] ?? null;
return array( $before, $style ? basename( $style->src ) : null );
