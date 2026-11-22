<?php
// Adds the old category fields to a category term, object or array: cat_ID, category_count, category_description, cat_name, category_nicename, category_parent.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
$cat = get_term( $local, 'category' );
_make_cat_compat( $cat );
$arr = (array) get_term( $news, 'category' );
_make_cat_compat( $arr );
return array( $cat->cat_name, $cat->category_nicename, $cat->category_parent, $arr['cat_ID'] );
