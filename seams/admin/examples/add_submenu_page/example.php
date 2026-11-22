<?php
// Adds a page under any top-level admin menu by its slug; gives its hook suffix, or false when the user lacks the capability.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_menu_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
$hook = add_submenu_page( 'tea', 'Tea blends', 'Blends', 'manage_options', 'tea-blends', 'guide_tea_page' );
return array( $hook, wp_list_pluck( $GLOBALS['submenu']['tea'], 2 ) );
