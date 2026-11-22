<?php
// Hooks WordPress's menus to admin_bar_menu at their priorities, then fires add_admin_bar_menus.
add_action( 'add_admin_bar_menus', fn() => print( "add_admin_bar_menus\n" ) );
( new WP_Admin_Bar() )->add_menus();
return array_map( fn( $p ) => implode( ',', array_keys( $p ) ), array_map( fn( $callbacks ) => $callbacks, $GLOBALS['wp_filter']['admin_bar_menu']->callbacks ) );
