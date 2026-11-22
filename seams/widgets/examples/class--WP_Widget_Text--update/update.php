<?php
// Text widget settings are cleaned on save: the title stripped of tags; the text kept for users who may post unfiltered HTML, else run through wp_kses_post().
$widget = $GLOBALS['wp_widget_factory']->get_widget_object( 'text' );
return $widget->update( array( 'title' => '<b>Hi</b>', 'text' => '<p>Ok</p><script>x()</script>', 'filter' => true, 'visual' => true ), array() );
