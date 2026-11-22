<?php
// Adds a style fragment to the group for its selector.
$groups = array();
wp_add_state_style_group( $groups, '.a', array( 'color' => array( 'text' => 'red' ) ) );
wp_add_state_style_group( $groups, '.a', array( 'color' => array( 'background' => 'blue' ) ) );
return $groups;
