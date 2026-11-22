<?php
// Queues the block directory's script and style in the editor.
wp_enqueue_editor_block_directory_assets();
return array( wp_script_is( 'wp-block-directory' ), wp_style_is( 'wp-block-directory' ) );
