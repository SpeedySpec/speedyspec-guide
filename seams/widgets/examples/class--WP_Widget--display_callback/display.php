<?php
// Prints one saved instance through widget(); widget_display_callback can change it or skip it with false. An unsaved number prints nothing.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'text' );
$widget->save_settings( array( 4 => array( 'title' => 'Note', 'text' => 'Saved text' ) ) );
$args = array( 'before_widget' => '<div>', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>' );
$shown = guide_render( fn() => $widget->display_callback( $args, 4 ) );
add_filter( 'widget_display_callback', '__return_false' );
return array( $shown, guide_render( fn() => $widget->display_callback( $args, 4 ) ), guide_render( fn() => $widget->display_callback( $args, 9 ) ) );
