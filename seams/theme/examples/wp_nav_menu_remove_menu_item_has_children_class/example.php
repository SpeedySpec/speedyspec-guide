<?php
// Hooked to nav_menu_css_class: removes menu-item-has-children when the menu's depth stops before the children show.
return wp_nav_menu_remove_menu_item_has_children_class( array( 'menu-item', 'menu-item-has-children' ), (object) array(), (object) array( 'depth' => 1 ), 1 );
