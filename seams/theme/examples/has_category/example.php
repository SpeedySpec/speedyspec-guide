<?php
// Whether a post has any category, or the given ones.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return array( has_category(), has_category( 'local' ), has_category( 'sports' ) );
