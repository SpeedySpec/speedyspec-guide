<?php
// Removes a top-level admin menu page by its slug; gives the removed item or false.
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_menu_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page', '', 30 );
$removed = remove_menu_page( 'tea' );
return array( $removed[2], isset( $GLOBALS['menu'][30] ) );
