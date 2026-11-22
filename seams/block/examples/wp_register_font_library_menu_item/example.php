<?php
// Registers a menu item of the full-page Font Library app.
wp_register_font_library_menu_item( 'my-plugin', 'My Plugin', '/my-plugin', 'tools', 'dropdown' );
$items = wp_get_font_library_menu_items();
return end( $items );
