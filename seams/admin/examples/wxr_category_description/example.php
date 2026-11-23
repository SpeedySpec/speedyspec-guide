<?php
// Prints a category's description as CDATA for the export; defined by export_wp().
guide_render( 'export_wp' );
$term = wp_insert_term( 'Green', 'category', array( 'description' => 'Grassy teas.' ) );
return guide_render( fn() => wxr_category_description( get_term( $term['term_id'] ) ) );
