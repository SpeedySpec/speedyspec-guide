<?php
// core/content-query reads posts of a post type exposed to abilities, filtered by IDs, slugs, status, author and parent, with chosen fields and pages.
guide_core_abilities();
$ability = wp_get_ability( 'core/content-query' );
$input = $ability->get_input_schema();
return array( $ability->get_category(), array_keys( $input['properties'] ), array_keys( $input['properties']['where']['properties'] ), $input['properties']['where']['properties']['type']['enum'] ?? null, $input['properties']['where']['required'] ?? null, array_keys( $ability->get_output_schema()['properties'] ) );
