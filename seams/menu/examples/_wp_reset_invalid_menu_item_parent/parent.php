<?php
// Clears an item's parent when it is set to the item itself (the menus screen uses it when moving items).
return array( _wp_reset_invalid_menu_item_parent( array( 'ID' => 5, 'menu_item_parent' => 5 ) ), _wp_reset_invalid_menu_item_parent( array( 'ID' => 5, 'menu_item_parent' => 4 ) ), _wp_reset_invalid_menu_item_parent( 'x' ) );
