<?php
// Queues the format library's script and style in the editor.
wp_enqueue_editor_format_library_assets();
return array( wp_script_is( 'wp-format-library' ), wp_style_is( 'wp-format-library' ) );
