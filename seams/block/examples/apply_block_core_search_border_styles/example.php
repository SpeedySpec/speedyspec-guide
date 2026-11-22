<?php
// Adds the CSS rules for a border property to the Search block's wrapper, button and input styles.
$wrapper = array();
$button = array();
$input = array();
apply_block_core_search_border_styles( array( 'buttonPosition' => 'button-outside', 'style' => array( 'border' => array( 'color' => '#111111' ) ) ), 'color', $wrapper, $button, $input );
return array( $wrapper, $button, $input );
