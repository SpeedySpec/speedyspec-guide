<?php
// The current post's categories and tags as RSS category or Atom category elements, or RDF dc:subject; filtered by the_category_rss.
$term = wp_insert_term( 'Green', 'category' );
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_category' => array( $term['term_id'] ), 'tags_input' => array( 'grassy' ) ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return array( trim( get_the_category_rss( 'rss2' ) ), trim( get_the_category_rss( 'atom' ) ) );
