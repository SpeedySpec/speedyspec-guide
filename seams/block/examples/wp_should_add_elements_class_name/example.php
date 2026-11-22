<?php
// Whether a block sets element styles (link, heading, button and the rest) that need a scoping class.
return array( wp_should_add_elements_class_name( array( 'attrs' => array( 'style' => array( 'elements' => array( 'link' => array( 'color' => array( 'text' => 'red' ) ) ) ) ) ), array( 'link' => array( 'skip' => false, 'paths' => array( array( 'link', 'color', 'text' ) ) ) ) ), wp_should_add_elements_class_name( array( 'attrs' => array() ), array() ) );
