<?php
// Adds a widget to the dashboard, with a callback that prints it and an optional control form, in a context and priority.
set_current_screen( 'dashboard' );
function guide_tea_widget(): void
{
	echo '<p>Today: oolong.</p>';
}
wp_add_dashboard_widget( 'guide_tea', 'Tea of the day', 'guide_tea_widget', null, null, 'side', 'high' );
return array_keys( $GLOBALS['wp_meta_boxes']['dashboard']['side']['high'] );
