<?php
// The custom CSS a block instance sets for its default state, its pseudo states and its viewport states, each with its media query.
$entries = wp_get_custom_css_state_entries( array( 'css' => 'color: red;', ':hover' => array( 'css' => 'color: blue;' ) ), 'core/button', array() );
return array_map( fn( $e ) => array_keys( $e ), $entries );
