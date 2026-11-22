<?php
// Adds a CSS rule for one border property and side to the Search block's wrapper, button or input styles.
$wrapper = array();
$button = array();
$input = array();
apply_block_core_search_border_style( array( 'buttonPosition' => 'button-inside', 'style' => array( 'border' => array( 'top' => array( 'width' => '2px' ) ) ) ), 'width', 'top', $wrapper, $button, $input );
return array( $wrapper, $button, $input );
