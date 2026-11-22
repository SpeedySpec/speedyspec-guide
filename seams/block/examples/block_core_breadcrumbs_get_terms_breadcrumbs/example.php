<?php
// Breadcrumb items from a post's terms in a taxonomy, with their ancestors.
$food = wp_insert_term( 'Food', 'category' );
$baking = wp_insert_term( 'Baking', 'category', array( 'parent' => $food['term_id'] ) );
$id = wp_insert_post( array( 'post_title' => 'Rye', 'post_status' => 'publish', 'post_category' => array( $baking['term_id'] ) ) );
return wp_list_pluck( block_core_breadcrumbs_get_terms_breadcrumbs( $id, 'post' ), 'label' );
