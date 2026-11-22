<?php
// Registers a menu item of the full-page Connectors settings app.
wp_register_options_connectors_menu_item( 'my-plugin', 'My Plugin', '/my-plugin', 'tools', 'dropdown' );
$items = wp_get_options_connectors_menu_items();
return end( $items );
