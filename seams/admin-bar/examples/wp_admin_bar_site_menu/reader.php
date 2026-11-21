<?php
// A member with only read gets the site name, Dashboard and the Appearance group, which has nothing under it without switch_themes or edit_theme_options.
guide_log_in( array( 'read' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_site_menu( $bar );
return guide_nodes( $bar );
