<?php
// Outside recovery mode, nothing is added.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_recovery_mode_menu( $bar );
return guide_nodes( $bar );
