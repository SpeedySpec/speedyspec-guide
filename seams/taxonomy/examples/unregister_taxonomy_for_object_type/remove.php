<?php
// Removes an object type from a taxonomy; false when it wasn't there.
return array( unregister_taxonomy_for_object_type( 'category', 'post' ), get_object_taxonomies( 'post' ), unregister_taxonomy_for_object_type( 'category', 'post' ) );
