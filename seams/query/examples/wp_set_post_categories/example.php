<?php
// Sets a post's categories, the default category when none are given.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
$news = wp_insert_term( 'News', 'category' )['term_id'];
wp_set_post_categories( $id, array( $news ) );
$set = wp_get_post_categories( $id, array( 'fields' => 'names' ) );
wp_set_post_categories( $id, array() );
return array( $set, wp_get_post_categories( $id, array( 'fields' => 'names' ) ) );
