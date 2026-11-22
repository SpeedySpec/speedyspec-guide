<?php
// Breadcrumb items for an archive: its post type, term, author or date.
$term = wp_insert_term( 'Recipes', 'category' );
wp_insert_post( array( 'post_title' => 'Rye', 'post_status' => 'publish', 'post_category' => array( $term['term_id'] ) ) );
guide_go( '/?cat=' . $term['term_id'] );
return wp_list_pluck( block_core_breadcrumbs_get_archive_breadcrumbs(), 'label' );
