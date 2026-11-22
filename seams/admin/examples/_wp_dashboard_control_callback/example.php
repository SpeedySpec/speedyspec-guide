<?php
// Prints the form of a dashboard widget's settings, with the widget's own control and the save fields.
set_current_screen( 'dashboard' );
function guide_tea_widget(): void
{
	echo '<p>Today: oolong.</p>';
}
function guide_tea_control(): void
{
	echo '<input name="tea">';
}
wp_add_dashboard_widget( 'guide_tea', 'Tea of the day', 'guide_tea_widget', 'guide_tea_control' );
$html = guide_render( fn() => _wp_dashboard_control_callback( '', array( 'id' => 'guide_tea' ) ) );
return array( str_contains( $html, 'name="tea"' ), str_contains( $html, 'dashboard-widget-control-form' ) );
