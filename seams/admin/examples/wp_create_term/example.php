<?php
// The ID of a term by name in a taxonomy, creating it when missing.
$term = wp_create_term( 'Herbal', 'category' );
return array( get_term( $term['term_id'] )->name, wp_create_term( 'Herbal', 'category' ) == $term );
