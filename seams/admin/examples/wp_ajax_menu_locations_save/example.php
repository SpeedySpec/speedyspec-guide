<?php
// Ajax handler that saves which menu is assigned to each theme location.
$menu = wp_create_nav_menu( 'Main' );
register_nav_menus( array( 'primary' => 'Primary' ) );
guide_ajax( 'wp_ajax_menu_locations_save', array( 'menu-locations' => array( 'primary' => $menu ), 'menu-settings-column-nonce' => wp_create_nonce( 'add-menu_item' ) ) );
return get_nav_menu_locations();
