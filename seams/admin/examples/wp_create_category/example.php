<?php
// The ID of a category by name, creating it under a parent when it doesn't exist.
$id = wp_create_category( 'Herbal' );
return array( $id === wp_create_category( 'Herbal' ), get_cat_name( $id ) );
