<?php
// Adds the embed context to a wp_navigation post's status, content and title in the REST schema, so the fallback can be embedded.
$context = array( 'context' => array( 'view', 'edit' ) );
$schema = array( 'properties' => array( 'status' => $context, 'content' => $context + array( 'properties' => array( 'raw' => $context, 'rendered' => $context, 'block_version' => $context ) ), 'title' => array( 'properties' => array( 'raw' => $context ) ) ) );
$schema = WP_Navigation_Fallback::update_wp_navigation_post_schema( $schema );
return array( $schema['properties']['status']['context'], $schema['properties']['content']['properties']['rendered']['context'], $schema['properties']['title']['properties']['raw']['context'] );
