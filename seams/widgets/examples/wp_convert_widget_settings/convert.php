<?php
// Converts a single widget's settings to the multi-widget form: number 2, and _multiwidget; in the admin it renames the widget in the sidebars and saves both. Multi-widget settings only gain _multiwidget.
wp_set_sidebars_widgets( array( 'side' => array( 'legacy' ) ) );
$single = wp_convert_widget_settings( 'legacy', 'widget_legacy', array( 'title' => 'Old' ) );
return array( $single, wp_convert_widget_settings( 'multi', 'widget_multi', array( 3 => array( 'title' => 'A' ) ) ), $GLOBALS['_wp_sidebars_widgets']['side'] );
