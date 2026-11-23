<?php
// Prints a tag's description as CDATA for the export; defined by export_wp().
guide_render( 'export_wp' );
$term = wp_insert_term( 'oolong', 'post_tag', array( 'description' => 'Partly oxidised.' ) );
return guide_render( fn() => wxr_tag_description( get_term( $term['term_id'] ) ) );
