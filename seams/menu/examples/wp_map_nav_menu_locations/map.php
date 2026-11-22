<?php
// Carries menu assignments to a new theme's locations: same slugs keep their menus, one old and one new location pair up, and otherwise common slugs (primary/main/header, secondary/footer, social) are matched.
register_nav_menus( array( 'header-menu' => 'Header', 'footer-links' => 'Footer', 'social' => 'Social' ) );
return array( wp_map_nav_menu_locations( array(), array( 'primary' => 3, 'footer' => 4, 'social' => 5 ) ), wp_map_nav_menu_locations( array( 'unknown' => 9 ), array() ) );
