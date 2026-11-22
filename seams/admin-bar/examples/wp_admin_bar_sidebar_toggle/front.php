<?php
// Only in the admin; on the front end it adds nothing.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_sidebar_toggle( $bar );
return guide_nodes( $bar );
