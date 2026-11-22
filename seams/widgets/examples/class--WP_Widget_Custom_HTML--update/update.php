<?php
// Custom HTML is kept as given for users who may post unfiltered HTML, else run through wp_kses_post(); the title is cleaned.
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'custom_html' );
return $widget->update( array( 'title' => '<i>T</i>', 'content' => '<p>Ok</p><script>x()</script>' ), array() );
