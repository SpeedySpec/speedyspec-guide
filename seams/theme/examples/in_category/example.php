<?php
// Whether a post is in a category, by ID, name or slug; a parent category doesn't count for its children's posts.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return array( in_category( 'local' ), in_category( $news ), in_category( 'Local' ) );
