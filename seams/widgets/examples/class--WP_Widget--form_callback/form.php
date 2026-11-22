<?php
// Prints a widget's form for a number, or for a new widget (number __i__) with -1; widget_form_callback can change the instance, and in_widget_form fires after the form.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'search' );
$widget->save_settings( array( 2 => array( 'title' => 'Find' ) ) );
function guide_print_in_widget_form( $widget, &$return, $instance ) {
	echo '<!-- in_widget_form -->';
}
add_action( 'in_widget_form', 'guide_print_in_widget_form', 10, 3 );
$saved = guide_render( fn() => $widget->form_callback( 2 ) );
return array( $saved, $widget->id, guide_render( fn() => $widget->form_callback( -1 ) ), $widget->id );
