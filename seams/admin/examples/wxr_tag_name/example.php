<?php
// Prints a tag's name as CDATA for the export; defined by export_wp().
guide_render( 'export_wp' );
$term = wp_insert_term( 'oolong', 'post_tag' );
return guide_render( fn() => wxr_tag_name( get_term( $term['term_id'] ) ) );
