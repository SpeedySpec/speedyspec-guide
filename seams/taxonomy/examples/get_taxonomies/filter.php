<?php
// Registered taxonomies matching arguments (and or or), as names or objects, or one field of each.
return array( get_taxonomies( array( 'public' => true ) ), get_taxonomies( array( 'hierarchical' => true, 'public' => true ), 'names', 'and' ), get_taxonomies( array( 'name' => 'category' ), 'objects' )['category']->label );
