<?php
// A term's description, the queried term's by default.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
wp_update_term( $news, 'category', array( 'description' => 'All the news.' ) );
guide_go( "/?cat=$news" );
return term_description();
