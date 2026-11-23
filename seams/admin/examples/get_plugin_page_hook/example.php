<?php
// The hook suffix of a registered plugin admin page, or null when nothing is hooked to it.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_options_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
return array( get_plugin_page_hook( 'tea', 'options-general.php' ), get_plugin_page_hook( 'nope', 'options-general.php' ) );
