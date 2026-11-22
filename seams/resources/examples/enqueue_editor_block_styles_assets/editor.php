<?php
// Registers and queues the editor script that registers the server's block styles with the editor.
register_block_style( 'core/quote', array( 'name' => 'guide', 'label' => 'Guide' ) );
enqueue_editor_block_styles_assets();
return array( wp_script_is( 'wp-block-styles' ), str_contains( implode( '', (array) wp_scripts()->get_data( 'wp-block-styles', 'after' ) ), 'guide' ) );
