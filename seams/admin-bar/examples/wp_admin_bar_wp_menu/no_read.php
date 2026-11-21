<?php
// Without read (and not multisite) the logo has no link and only the external links remain.
guide_log_in( array() );
$bar = new WP_Admin_Bar();
wp_admin_bar_wp_menu( $bar );
return guide_nodes( $bar );
