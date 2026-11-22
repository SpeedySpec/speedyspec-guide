<?php
// An ID that isn't a menu item, or a menu that doesn't exist, is refused; a menu ID of 0 saves an orphaned item, marked with _menu_item_orphaned.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About' ) );
$orphan = wp_update_nav_menu_item( 0, 0, array( 'menu-item-title' => 'Loose' ) );
return array( wp_update_nav_menu_item( 0, $page )->get_error_code(), wp_update_nav_menu_item( 999 )->get_error_code(), get_post_meta( $orphan, '_menu_item_orphaned', true ) > 0, get_post( $orphan )->menu_order );
