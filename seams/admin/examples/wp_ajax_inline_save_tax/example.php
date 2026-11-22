<?php
// Ajax handler for Quick Edit in a terms list: saves the term's name and slug and prints its updated row.
$term = wp_insert_term( 'Tea', 'category' );
guide_ajax( 'wp_ajax_inline_save_tax', array( 'tax_ID' => $term['term_id'], 'taxonomy' => 'category', 'name' => 'Green tea', 'slug' => 'green-tea', 'screen' => 'edit-category', '_inline_edit' => wp_create_nonce( 'taxinlineeditnonce' ) ) );
return get_term( $term['term_id'] )->name;
