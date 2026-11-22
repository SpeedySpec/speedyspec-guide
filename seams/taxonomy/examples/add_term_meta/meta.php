<?php
// Term meta, like post meta: add_term_meta(), get_term_meta(), update_term_meta(), delete_term_meta(); shared terms (one ID in two taxonomies) refuse it.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$id = $news['term_id'];
$added = add_term_meta( $id, 'color', 'red', true );
update_term_meta( $id, 'size', 'L' );
$all = get_term_meta( $id );
delete_term_meta( $id, 'color' );
return array( is_int( $added ), add_term_meta( $id, 'size', 'M', true ), $all, get_term_meta( $id, 'color', true ), has_term_meta( $id ) );
