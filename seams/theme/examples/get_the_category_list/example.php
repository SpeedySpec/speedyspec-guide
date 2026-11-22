<?php
// A post's categories as links, in a list or joined by a separator, optionally with their parents; filtered by the_category.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return array( get_the_category_list( ', ' ), get_the_category_list( ', ', 'multiple' ) );
