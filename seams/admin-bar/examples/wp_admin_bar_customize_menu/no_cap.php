<?php
// It needs customize, outside the admin, and a theme that isn't a block theme without Customizer controls.
guide_log_in( array( 'read' => true ) );
$bar = new WP_Admin_Bar();
wp_admin_bar_customize_menu( $bar );
return guide_nodes( $bar );
