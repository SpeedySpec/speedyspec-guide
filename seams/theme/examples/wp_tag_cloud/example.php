<?php
// Prints (or gives) a cloud of tags sized by their counts, as links; filtered by wp_tag_cloud.
$news = wp_insert_term( 'News', 'category' )['term_id'];
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news ) )['term_id'];
$id = wp_insert_post( array( 'post_title' => 'Story', 'post_status' => 'publish', 'post_category' => array( $local ), 'tags_input' => array( 'red', 'blue' ) ) );
guide_go( "/?p=$id" );
the_post();
return wp_tag_cloud( array( 'echo' => false, 'format' => 'flat' ) );
