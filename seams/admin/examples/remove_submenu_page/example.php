<?php
// Removes a submenu page by its parent and its own slug; gives the removed item or false.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_options_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
$removed = remove_submenu_page( 'options-general.php', 'tea' );
return array( $removed[2], remove_submenu_page( 'options-general.php', 'tea' ) );
