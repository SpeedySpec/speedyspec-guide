<?php
// Prints the current post's terms as category elements for the export; defined by export_wp().
guide_render( 'export_wp' );
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish', 'tags_input' => array( 'oolong' ) ) ) );
return guide_render( 'wxr_post_taxonomy' );
