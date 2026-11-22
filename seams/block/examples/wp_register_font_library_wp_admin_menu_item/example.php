<?php
// Registers a menu item of the Font Library page inside wp-admin.
wp_register_font_library_wp_admin_menu_item( 'my-plugin', 'My Plugin', '/my-plugin', 'tools' );
$items = wp_get_font_library_wp_admin_menu_items();
return end( $items );
