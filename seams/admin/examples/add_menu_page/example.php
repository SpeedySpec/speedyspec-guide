<?php
// Adds a top-level admin menu page with a title, capability, slug, callback, icon and position; gives its hook suffix.
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
$hook = add_menu_page( 'Tea settings', 'Tea', 'manage_options', 'tea', 'guide_tea_page', 'dashicons-coffee', 30 );
return array( $hook, $GLOBALS['menu'][30][2] );
