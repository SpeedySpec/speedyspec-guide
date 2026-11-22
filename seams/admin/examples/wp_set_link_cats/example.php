<?php
// Sets a link's categories, the default link category when none are given.
$cat = wp_insert_term( 'Friends', 'link_category' );
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example' ) );
wp_set_link_cats( $id, array( $cat['term_id'] ) );
return wp_get_link_cats( $id ) === array( $cat['term_id'] );
