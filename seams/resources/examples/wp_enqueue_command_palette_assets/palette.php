<?php
// Queues the command palette's script and style for users who can use it, with the admin menu's commands.
wp_enqueue_command_palette_assets();
return array( wp_script_is( 'wp-core-commands' ), wp_style_is( 'wp-commands' ) );
