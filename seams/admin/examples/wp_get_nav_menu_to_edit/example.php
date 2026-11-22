<?php
// The HTML of a menu's items for the menus screen, each with its editable settings.
$menu = wp_create_nav_menu( 'Main' );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'publish' ) );
$html = wp_get_nav_menu_to_edit( $menu );
return array( str_contains( $html, 'menu-to-edit' ), str_contains( $html, 'Docs' ) );
