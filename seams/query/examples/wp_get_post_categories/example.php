<?php
// A post's categories, as IDs by default.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$news = wp_insert_term( 'News', 'category' )['term_id'];
wp_set_post_categories( $id, array( $news ) );
return array( wp_get_post_categories( $id ) === array( $news ), wp_get_post_categories( $id, array( 'fields' => 'names' ) ) );
