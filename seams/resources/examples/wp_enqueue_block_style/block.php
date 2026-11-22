<?php
// Adds a stylesheet for a block, loaded only when the block is shown (or always when blocks don't load on demand); with a path it can be inlined.
wp_enqueue_block_style( 'core/quote', array( 'handle' => 'guide-quote', 'src' => 'https://cdn.example/quote.css' ) );
$before = wp_style_is( 'guide-quote' );
do_action( 'wp_enqueue_scripts' );
render_block( array( 'blockName' => 'core/quote', 'attrs' => array(), 'innerBlocks' => array(), 'innerHTML' => '<blockquote class="wp-block-quote"><p>Hi</p></blockquote>', 'innerContent' => array( '<blockquote class="wp-block-quote"><p>Hi</p></blockquote>' ) ) );
return array( $before, wp_style_is( 'guide-quote' ) );
