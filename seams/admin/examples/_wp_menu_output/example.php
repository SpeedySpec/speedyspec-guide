<?php
// Prints the admin menu's items and submenus as list items, marking the current ones.
guide_admin_menu();
$page = guide_render( function () {
	global $menu, $submenu, $self, $parent_file, $submenu_file, $plugin_page, $typenow;
	include ABSPATH . 'wp-admin/menu-header.php';
} );
$html = guide_render( fn() => _wp_menu_output( $GLOBALS['menu'], $GLOBALS['submenu'] ) );
return array( str_contains( $html, 'menu-dashboard' ), str_contains( $page, 'adminmenu' ) );
