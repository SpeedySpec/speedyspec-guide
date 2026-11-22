<?php
// Prints a taxonomy's most used terms as checkboxes for the Most Used tab; gives their IDs.
$green = wp_insert_term( 'Green', 'category' );
wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_category' => array( $green['term_id'] ) ) );
$ids = wp_popular_terms_checklist( 'category', 0, 10, false );
return $ids === array( $green['term_id'] );
