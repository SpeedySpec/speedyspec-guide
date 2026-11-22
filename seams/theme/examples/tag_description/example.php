<?php
// A tag's description.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
$red = get_term_by( 'slug', 'red', 'post_tag' );
wp_update_term( $red->term_id, 'post_tag', array( 'description' => 'Warm.' ) );
return tag_description( $red->term_id );
