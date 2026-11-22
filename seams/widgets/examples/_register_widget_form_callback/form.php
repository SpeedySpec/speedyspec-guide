<?php
// Registers a widget's form callback by ID; before widgets_init an existing one is kept. An empty callback removes it.
_register_widget_form_callback( 'Guide-2', 'Guide', 'guide_form', array( 'width' => 400 ) );
$form = $GLOBALS['wp_registered_widget_controls']['guide-2'];
_register_widget_form_callback( 'guide-2', 'Guide', '' );
return array( $form['callback'], $form['width'], isset( $GLOBALS['wp_registered_widget_controls']['guide-2'] ) );
