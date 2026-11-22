<?php
// Hooked to admin_menu: moves the Theme File Editor to the end of the Appearance menu.
guide_admin_menu();
_add_themes_utility_last();
$items = $GLOBALS['submenu']['themes.php'];
return end( $items )[2];
