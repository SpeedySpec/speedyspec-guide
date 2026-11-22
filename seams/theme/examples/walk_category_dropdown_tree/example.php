<?php
// Walks categories with Walker_CategoryDropdown, or a given walker, to render select options.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return walk_category_dropdown_tree( get_categories( array( 'hide_empty' => 0 ) ), 0, array( 'selected' => $news, 'show_count' => 0, 'value_field' => 'term_id' ) );
