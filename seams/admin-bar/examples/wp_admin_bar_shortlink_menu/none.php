<?php
// With no shortlink for the current page, nothing is added.
$bar = new WP_Admin_Bar();
wp_admin_bar_shortlink_menu( $bar );
return guide_nodes( $bar );
