<?php
// A category by its slug path; with $full_match false (the default is true) the last slug is enough when its ancestors match the path given.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
return array( get_category_by_path( 'news/local' )->name, get_category_by_path( 'local' ), get_category_by_path( 'local', false )->name, get_category_by_path( 'nope/local' ) );
