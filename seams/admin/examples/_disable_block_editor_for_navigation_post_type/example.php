<?php
// Hooked to use_block_editor_for_post_type: turns the block editor off for wp_navigation, which is edited in the site editor.
return array( _disable_block_editor_for_navigation_post_type( true, 'wp_navigation' ), _disable_block_editor_for_navigation_post_type( true, 'post' ) );
