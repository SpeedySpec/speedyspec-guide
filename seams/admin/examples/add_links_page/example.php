<?php
// Adds a page under the Links menu (link-manager.php), shown to users with a capability; gives the hook suffix of its load-* and admin_print_* hooks, or false.
update_option( 'link_manager_enabled', 1 );
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
$hook = add_links_page( 'Tea settings', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
return array( $hook, array_slice( $GLOBALS['submenu']['link-manager.php'], -1 )[0][2] );
