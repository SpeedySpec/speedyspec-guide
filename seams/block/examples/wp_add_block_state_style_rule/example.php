<?php
// Adds a compiled state rule (selector and declarations) to a rule list, unless it has no declarations.
$rules = array();
wp_add_block_state_style_rule( $rules, ':hover', '.wp-block-button__link', array( 'color' => array( 'text' => 'red' ) ) );
return $rules;
