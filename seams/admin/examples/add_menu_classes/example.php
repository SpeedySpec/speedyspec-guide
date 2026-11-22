<?php
// Adds the classes of the admin menu's first and last items and of the separators around them.
guide_admin_menu();
$menu = add_menu_classes( $GLOBALS['menu'] );
$first = reset( $menu );
return str_contains( $first[4], 'menu-top-first' );
