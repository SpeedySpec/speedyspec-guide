<?php
// Prints a taxonomy's terms as nested checkboxes, the post's terms checked and listed first.
$green = wp_insert_term( 'Green', 'category' );
$post = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_category' => array( $green['term_id'] ) ) );
$html = guide_render( fn() => wp_terms_checklist( $post ) );
return array( substr_count( $html, 'type="checkbox"' ), str_contains( $html, "checked='checked'" ) );
