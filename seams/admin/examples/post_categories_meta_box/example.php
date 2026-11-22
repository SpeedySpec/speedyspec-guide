<?php
// Prints a hierarchical taxonomy's box, such as Categories: the All and Most Used tabs, the checklist and the Add New form.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
$html = guide_render( fn() => post_categories_meta_box( $post, array( 'args' => array( 'taxonomy' => 'category' ), 'title' => 'Categories' ) ) );
return array( str_contains( $html, 'categorychecklist' ), str_contains( $html, 'category-add' ) );
