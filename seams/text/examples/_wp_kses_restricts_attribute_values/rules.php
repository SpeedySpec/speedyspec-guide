<?php
// Says whether any allowed attribute has a rule on its value, beyond required and valueless.
return array( _wp_kses_restricts_attribute_values( array( 'href' => true ) ), _wp_kses_restricts_attribute_values( array( 'type' => array( 'values' => array( 'a' ) ) ) ) );
