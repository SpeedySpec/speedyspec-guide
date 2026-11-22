<?php
// Whether the block-based widgets editor is used: the theme support, through use_widgets_block_editor.
wp_setup_widgets_block_editor();
add_filter( 'use_widgets_block_editor', '__return_false' );
return wp_use_widgets_block_editor();
