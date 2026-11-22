<?php
// Walks categories with Walker_Category, or a given walker, to render them.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return walk_category_tree( get_categories( array( 'hide_empty' => 0 ) ), 0, array( 'style' => 'list', 'use_desc_for_title' => 0, 'show_count' => 0 ) );
