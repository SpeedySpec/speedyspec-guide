<?php
// Says whether a data-wp-bind directive would set an attribute whose values kses restricts, so the directive must go.
$allowed = array( 'type' => array( 'values' => array( 'a' ) ), 'title' => true );
return array( _wp_kses_directive_binds_value_restricted_attribute( 'data-wp-bind--type', $allowed ), _wp_kses_directive_binds_value_restricted_attribute( 'data-wp-text', $allowed ) );
