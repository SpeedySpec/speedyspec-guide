<?php
// On the front end, it edits the queried object; with nothing queried it adds nothing.
$GLOBALS['wp_the_query'] = new class { public function get_queried_object() { return null; } };
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_edit_menu( $bar );
return guide_nodes( $bar );
