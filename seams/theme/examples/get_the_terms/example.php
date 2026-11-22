<?php
// A post's terms in a taxonomy, cached; false when none, an error for a bad taxonomy; filtered by get_the_terms.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return array( wp_list_pluck( get_the_terms( $id, 'post_tag' ), 'name' ), get_the_terms( $id, 'nope' )->get_error_code() );
