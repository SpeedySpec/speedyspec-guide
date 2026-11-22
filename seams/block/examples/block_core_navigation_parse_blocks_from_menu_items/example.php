<?php
// Parsed Navigation Link and Submenu blocks from classic menu items, nested.
$menu = wp_create_nav_menu( 'Main' );
$top = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'Docs', 'menu-item-url' => 'https://example.org/docs', 'menu-item-status' => 'publish' ) );
wp_update_nav_menu_item( $menu, 0, array( 'menu-item-title' => 'API', 'menu-item-url' => 'https://example.org/api', 'menu-item-parent-id' => $top, 'menu-item-status' => 'publish' ) );
$items = wp_get_nav_menu_items( $menu );
$by_parent = array();
foreach ( $items as $item ) {
	$by_parent[ $item->menu_item_parent ][] = $item;
}
$blocks = block_core_navigation_parse_blocks_from_menu_items( $by_parent[0], $by_parent );
return array( $blocks[0]['blockName'], $blocks[0]['innerBlocks'][0]['attrs']['label'] );
