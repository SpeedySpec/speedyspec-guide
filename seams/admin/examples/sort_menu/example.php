<?php
// Compares two admin menu items by the order a menu_order callback gave, for usort(); defined only when custom_menu_order is on.
add_filter( 'custom_menu_order', '__return_true' );
guide_admin_menu();
$GLOBALS['menu_order'] = array_flip( array( 'index.php', 'upload.php', 'edit.php' ) );
$GLOBALS['default_menu_order'] = $GLOBALS['menu_order'];
$items = array( array( 'Posts', 'read', 'edit.php' ), array( 'Media', 'read', 'upload.php' ), array( 'Dashboard', 'read', 'index.php' ) );
usort( $items, 'sort_menu' );
return wp_list_pluck( $items, 2 );
