<?php
// The WordPress logo menu: About and Get Involved for a user who can read, then the wordpress.org links in wp-logo-external.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_wp_menu( $bar );
return guide_nodes( $bar );
