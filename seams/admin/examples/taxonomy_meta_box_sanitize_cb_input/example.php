<?php
// Turns the comma-separated names a tag box submits into term IDs; a name with no term stays a name, so saving creates it.
$green = wp_insert_term( 'green', 'post_tag' );
$terms = taxonomy_meta_box_sanitize_cb_input( 'post_tag', 'green, unknown' );
return array( $terms[0] === $green['term_id'], $terms[1] );
