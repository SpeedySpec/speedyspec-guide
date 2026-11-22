<?php
// Decides whether one attribute is allowed on an element, passing data-* attributes when the element allows them.
$name = 'data-x'; $value = '1'; $whole = 'data-x="1"'; $vless = 'n';
$allowed = array( 'div' => array( 'data-*' => true ) );
return array( wp_kses_attr_check( $name, $value, $whole, $vless, 'div', $allowed ), $whole );
