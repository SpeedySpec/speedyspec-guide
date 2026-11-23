<?php
// Prints the Format box: a radio button for each post format the theme supports.
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
$html = guide_render( fn() => post_format_meta_box( $post, array() ) );
return array( str_contains( $html, 'post-format-aside' ), str_contains( $html, 'post-format-gallery' ) );
