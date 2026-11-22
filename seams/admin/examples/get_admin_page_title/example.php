<?php
// The title of the admin page being shown, from its menu entry.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_options_page( 'Tea settings', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
$GLOBALS['plugin_page'] = 'tea';
$GLOBALS['pagenow'] = 'admin.php';
$GLOBALS['title'] = '';
return get_admin_page_title();
