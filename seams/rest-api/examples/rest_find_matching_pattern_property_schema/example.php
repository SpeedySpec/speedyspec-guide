<?php
// The schema in patternProperties whose pattern matches a property name, or null.
$args = array( 'patternProperties' => array( '^x-' => array( 'type' => 'string' ) ) );
return array( rest_find_matching_pattern_property_schema( 'x-color', $args ), rest_find_matching_pattern_property_schema( 'color', $args ) );
