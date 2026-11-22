<?php
// Turns on the block-based widgets editor's theme support; wp_use_widgets_block_editor() says whether to use it.
$before = wp_use_widgets_block_editor();
wp_setup_widgets_block_editor();
return array( $before, wp_use_widgets_block_editor() );
