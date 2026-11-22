<?php
// Queues the styles of registered block styles: their stylesheets, or their inline CSS added to the block's style.
register_block_style( 'core/quote', array( 'name' => 'guide', 'label' => 'Guide', 'inline_style' => '.is-style-guide{color:red}' ) );
enqueue_block_styles_assets();
return array( wp_style_is( 'wp-block-quote' ) || wp_style_is( 'wp-block-library' ), str_contains( implode( '', (array) wp_styles()->get_data( wp_should_load_separate_core_block_assets() ? 'wp-block-quote' : 'wp-block-library', 'after' ) ), 'is-style-guide' ) );
