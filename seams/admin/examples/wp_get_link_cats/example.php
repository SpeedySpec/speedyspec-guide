<?php
// The IDs of a link's categories.
$cat = wp_insert_term( 'Friends', 'link_category' );
$id = wp_insert_link( array( 'link_url' => 'https://example.org/', 'link_name' => 'Example', 'link_category' => array( $cat['term_id'] ) ) );
return wp_get_link_cats( $id ) === array( $cat['term_id'] );
