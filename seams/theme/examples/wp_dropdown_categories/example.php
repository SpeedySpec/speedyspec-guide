<?php
// Prints (or gives) a select of categories or terms, hierarchical, with counts and an option for none; filtered by wp_dropdown_cats.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return wp_dropdown_categories( array( 'echo' => 0, 'hide_empty' => 0, 'hierarchical' => 1, 'name' => 'cat', 'show_option_none' => 'Pick one' ) );
