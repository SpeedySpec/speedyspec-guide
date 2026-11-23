<?php
// Hooked to a widget's control: prints its settings form, and saves it when submitted.
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
return guide_render( fn() => wp_dashboard_trigger_widget_control( 'guide_tea' ) );
