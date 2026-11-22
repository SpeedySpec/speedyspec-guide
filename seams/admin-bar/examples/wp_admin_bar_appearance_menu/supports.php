<?php
// The Appearance group: Themes with switch_themes; with edit_theme_options, Widgets, Menus, Background and Header as the theme supports them.
add_theme_support( 'widgets' );
add_theme_support( 'custom-header' );
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_appearance_menu( $bar );
return guide_nodes( $bar );
