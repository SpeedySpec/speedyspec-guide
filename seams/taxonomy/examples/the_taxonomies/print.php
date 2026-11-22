<?php
// Prints get_the_taxonomies() joined by a separator, with text before and after.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
return guide_render_out( fn() => the_taxonomies( array( 'post' => $post, 'before' => '<p>', 'sep' => '; ', 'after' => '</p>' ) ) );
