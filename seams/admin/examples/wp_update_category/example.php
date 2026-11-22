<?php
// Updates a category from its cat_ID and the fields given; gives its ID or false.
$id = wp_insert_category( array( 'cat_name' => 'Herbal' ) );
wp_update_category( array( 'cat_ID' => $id, 'cat_name' => 'Herbal tea' ) );
return get_cat_name( $id );
