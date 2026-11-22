<?php
// Hooked to nav_menu_item_id: gives a menu item's id attribute only the first time it renders, so a menu shown twice has unique ids.
$item = (object) array( 'ID' => 7 );
$first = _nav_menu_item_id_use_once( 'menu-item-7', $item );
return array( $first, _nav_menu_item_id_use_once( 'menu-item-7', $item ) );
