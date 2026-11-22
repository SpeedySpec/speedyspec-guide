<?php
// Adds an object type to a taxonomy, and unregister_taxonomy_for_object_type() removes it; registered_taxonomy_for_object_type fires.
$added = register_taxonomy_for_object_type( 'post_tag', 'page' );
$with = get_object_taxonomies( 'page' );
$removed = unregister_taxonomy_for_object_type( 'post_tag', 'page' );
return array( $added, $with, $removed, get_object_taxonomies( 'page' ), register_taxonomy_for_object_type( 'nope', 'page' ) );
