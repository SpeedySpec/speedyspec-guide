<?php
// Prints a non-hierarchical taxonomy's box, such as Tags: the add field and the post's terms.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft', 'tags_input' => array( 'oolong' ) ) ) );
$html = guide_render( fn() => post_tags_meta_box( $post, array( 'args' => array( 'taxonomy' => 'post_tag' ), 'title' => 'Tags' ) ) );
return array( str_contains( $html, 'tagsdiv' ), str_contains( $html, 'oolong' ) );
