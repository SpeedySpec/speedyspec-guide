<?php
// Prints a taxonomy's Add menu items box: Most Used, View All and Search tabs of checkboxes.
wp_insert_term( 'Green', 'category' );
$html = guide_render( fn() => wp_nav_menu_item_taxonomy_meta_box( null, array( 'id' => 'add-category', 'title' => 'Categories', 'args' => get_taxonomy( 'category' ) ) ) );
return array( str_contains( $html, 'taxonomy-category' ), str_contains( $html, 'Green' ) );
