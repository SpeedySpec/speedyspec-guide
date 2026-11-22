<?php
// Breadcrumb items for a hierarchical term's ancestors.
$food = wp_insert_term( 'Food', 'category' );
$baking = wp_insert_term( 'Baking', 'category', array( 'parent' => $food['term_id'] ) );
$bread = wp_insert_term( 'Bread', 'category', array( 'parent' => $baking['term_id'] ) );
return wp_list_pluck( block_core_breadcrumbs_get_term_ancestors_items( $bread['term_id'], 'category' ), 'label' );
