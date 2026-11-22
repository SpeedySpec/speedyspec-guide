<?php
// Registers an old-style widget's form callback (250 wide by default), and its update callback by ID base unless one is set; wp_unregister_widget_control() removes it.
function guide_legacy_control() { echo 'form'; }
wp_register_widget_control( 'Legacy-2', 'Legacy', 'guide_legacy_control', array( 'width' => '300' ), array( 'number' => 2 ) );
$control = $GLOBALS['wp_registered_widget_controls']['legacy-2'];
$update = $GLOBALS['wp_registered_widget_updates']['legacy'];
wp_unregister_widget_control( 'legacy-2' );
return array( $control['width'], $control['height'], $update['params'], isset( $GLOBALS['wp_registered_widget_controls']['legacy-2'] ) );
