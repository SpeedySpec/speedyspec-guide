<?php
// A category by ID or object, with the old category fields added (cat_ID, cat_name, ...); a missing one is null, or a WP_Error from get_term().
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$sport = wp_insert_term( 'Sport & Games', 'category', array( 'slug' => 'sport' ) )['term_id'];
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local ) ) );
$cat = get_category( $local );
return array( get_class( $cat ), $cat->name, $cat->cat_ID, $cat->category_parent, get_category( $local, ARRAY_A )['slug'], get_category( 999 ) );
