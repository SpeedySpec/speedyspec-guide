<?php
// The URL of an admin menu page by its slug, printed or given.
guide_admin_menu();
function guide_tea_page(): void
{
	echo '<h1>Tea</h1>';
}
add_options_page( 'Tea', 'Tea', 'manage_options', 'tea', 'guide_tea_page' );
return menu_page_url( 'tea', false );
