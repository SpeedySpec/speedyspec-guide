<?php
// The class name WordPress gives an element (button, caption, cite, heading) in theme.json styles, '' for others.
return array( wp_theme_get_element_class_name( 'button' ), wp_theme_get_element_class_name( 'caption' ), wp_theme_get_element_class_name( 'link' ) );
