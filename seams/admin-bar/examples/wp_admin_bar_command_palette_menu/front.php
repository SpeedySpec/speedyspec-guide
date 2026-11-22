<?php
// Only in the admin with the command palette's script enqueued; otherwise nothing.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_command_palette_menu( $bar );
return guide_nodes( $bar );
