<?php
// Hooked to transition_post_status: updates the term counts of a post whose status changed.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$news = wp_insert_term( 'News', 'category' )['term_id'];
wp_set_post_categories( $id, array( $news ) );
wp_update_post( array( 'ID' => $id, 'post_status' => 'draft' ) );
return get_term( $news )->count;
