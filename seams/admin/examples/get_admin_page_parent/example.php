<?php
// The parent menu file of the admin page being shown, found in the menus.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_options_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
$GLOBALS['plugin_page'] = 'tea';
$GLOBALS['pagenow'] = 'admin.php';
return get_admin_page_parent();
