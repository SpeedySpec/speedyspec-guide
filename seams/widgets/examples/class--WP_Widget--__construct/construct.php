<?php
// A widget's ID base (from its class when empty), option name widget_{id_base}, and its options with a class name.
class Guide_Box_Widget extends WP_Widget {}
$named = new Guide_Box_Widget( 'Box', 'Box' );
$auto = new class( '', 'Anonymous' ) extends WP_Widget {};
return array( $named->id_base, $named->option_name, $named->widget_options, $named->control_options, ( new WP_Widget( '', 'Base' ) )->id_base );
