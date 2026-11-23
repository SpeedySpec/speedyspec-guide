<?php
// Adds a page under the Media menu (upload.php), shown to users with a capability; gives the hook suffix of its load-* and admin_print_* hooks, or false.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
$hook = add_media_page( 'Tea settings', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
return array( $hook, array_slice( $GLOBALS['submenu']['upload.php'], -1 )[0][2] );
