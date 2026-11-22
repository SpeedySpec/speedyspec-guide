<?php
// On the front end, the site name links to the dashboard, with Dashboard, the Appearance group and Plugins under it, as the user's capabilities allow.
guide_log_in( array( 'read' => true, 'edit_posts' => true, 'switch_themes' => true, 'edit_theme_options' => true, 'activate_plugins' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_site_menu( $bar );
return guide_nodes( $bar );
