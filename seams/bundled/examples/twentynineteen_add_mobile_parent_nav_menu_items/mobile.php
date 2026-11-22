<?php
// Adds a copy of each primary menu parent inside its sub menu (with a negative ID and the mobile-parent-nav-menu-item class), so mobile visitors can still reach it; on wp_nav_menu_objects.
guide_theme( 'twentynineteen' );
$items = twentynineteen_add_mobile_parent_nav_menu_items( array( (object) array( 'ID' => 5, 'db_id' => 5, 'object_id' => 9, 'classes' => array( 'menu-item-has-children' ), 'menu_item_parent' => 0 ) ), (object) array( 'theme_location' => 'menu-1' ) );
return array_map( fn( $i ) => array( $i->ID, $i->classes, $i->menu_item_parent, $i->original_id ?? null ), $items );
