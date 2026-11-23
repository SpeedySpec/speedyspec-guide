<?php
// Creates or updates a category from cat_name, category_nicename, category_parent and description; gives its ID, 0 or an error.
$id = wp_insert_category( array( 'cat_name' => 'Herbal', 'category_description' => 'Caffeine-free.' ) );
return array( get_cat_name( $id ), category_description( $id ) );
