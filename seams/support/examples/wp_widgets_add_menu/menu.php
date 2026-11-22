<?php
// Adds Widgets under Appearance, when the theme supports widgets and isn't a block theme.
$GLOBALS['submenu'] = array();
add_theme_support( 'widgets' );
wp_widgets_add_menu();
return $GLOBALS['submenu']['themes.php'] ?? array();
