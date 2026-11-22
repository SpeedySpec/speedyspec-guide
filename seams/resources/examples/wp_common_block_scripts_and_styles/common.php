<?php
// Queues the block library's common styles on the front end and in the editor (and the theme styles when the theme supports them), and fires enqueue_block_assets.
function guide_print_enqueue_block_assets() {
	echo "enqueue_block_assets\n";
}
add_action( 'enqueue_block_assets', 'guide_print_enqueue_block_assets' );
wp_common_block_scripts_and_styles();
return wp_style_is( 'wp-block-library' );
