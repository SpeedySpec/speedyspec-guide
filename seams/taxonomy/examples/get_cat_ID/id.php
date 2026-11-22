<?php
// A category's ID by name, or 0.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
return array( get_cat_ID( 'Local' ), get_cat_ID( 'Nope' ) );
