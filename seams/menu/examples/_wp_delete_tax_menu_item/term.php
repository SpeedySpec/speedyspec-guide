<?php
// When a term is deleted, deletes the menu items that point at it (hooked to delete_term).
$menu = wp_create_nav_menu( 'Main' );
$category = wp_insert_term( 'News', 'category' );
$item = wp_update_nav_menu_item( $menu, 0, array( 'menu-item-type' => 'taxonomy', 'menu-item-object' => 'category', 'menu-item-object-id' => $category['term_id'] ) );
_wp_delete_tax_menu_item( $category['term_id'], $category['term_taxonomy_id'], 'category' );
return get_post( $item );
