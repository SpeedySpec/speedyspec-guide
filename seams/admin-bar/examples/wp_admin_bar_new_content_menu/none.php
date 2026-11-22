<?php
// With no post type shown in the admin bar and no create_users, there is nothing to add, so no New menu.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_new_content_menu( $bar );
return guide_nodes( $bar );
