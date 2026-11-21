<?php
// New links for each post type in the admin bar the user may create, first one as the menu's link, and User with create_users.
register_post_type( 'guide_note', array( 'public' => true, 'show_in_admin_bar' => true, 'rewrite' => false, 'query_var' => false, 'labels' => array( 'name_admin_bar' => 'Note' ) ) );
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'create_users' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_new_content_menu( $bar );
return guide_nodes( $bar );
