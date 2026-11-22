<?php
// Recounts terms now, with the taxonomy's update_count_callback (published posts for post taxonomies); edit_term_taxonomy and edited_term_taxonomy fire.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$draft = wp_insert_post( array( 'post_title' => 'Draft', 'post_status' => 'draft', 'post_category' => array( $local['term_id'] ) ) );
wp_update_term_count_now( array( $local['term_taxonomy_id'] ), 'category' );
return (int) $GLOBALS['wpdb']->get_var( "SELECT count FROM {$GLOBALS['wpdb']->term_taxonomy} WHERE term_taxonomy_id = {$local['term_taxonomy_id']}" );
