<?php
// Prints (or gives) a list of categories or terms linked to their archives, hierarchical, with counts and feeds; filtered by wp_list_categories.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return wp_list_categories( array( 'echo' => 0, 'title_li' => '', 'show_count' => 1 ) );
