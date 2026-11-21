<?php
// core/users-query lists users, filtered by IDs, slugs, usernames, roles or published posts, with chosen fields and pages.
guide_core_abilities();
$schema = wp_get_ability( 'core/users-query' )->get_input_schema();
return array( array_keys( $schema['properties']['where']['properties'] ), $schema['properties']['where']['properties']['roles']['items']['enum'], $schema['properties']['fields']['items']['enum'], $schema['properties']['pagination']['properties']['per_page'] );
