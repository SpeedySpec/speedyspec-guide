<?php
// After a theme switch, maps the old theme's menu locations (theme_switch_menu_locations) to the new theme's and deletes that option.
register_nav_menu( 'primary', 'Primary' );
update_option( 'theme_switch_menu_locations', array( 'main' => 3 ) );
_wp_menus_changed();
return array( get_nav_menu_locations(), get_option( 'theme_switch_menu_locations' ) );
