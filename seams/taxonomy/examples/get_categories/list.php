<?php
// Categories, as get_terms() with the category taxonomy; empty ones are hidden by default. get_categories filters the list; the old 'type' => 'link' argument maps to link categories.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
return array( wp_list_pluck( get_categories(), 'name' ), wp_list_pluck( get_categories( array( 'hide_empty' => false, 'orderby' => 'name' ) ), 'name' ) );
