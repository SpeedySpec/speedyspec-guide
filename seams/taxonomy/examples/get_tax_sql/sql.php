<?php
// The JOIN and WHERE clauses for a tax query, through WP_Tax_Query.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$sql = get_tax_sql( array( array( 'taxonomy' => 'category', 'terms' => array( $news['term_id'] ) ) ), $GLOBALS['wpdb']->posts, 'ID' );
return array( trim( $sql['join'] ), trim( preg_replace( '/\s+/', ' ', $sql['where'] ) ) );
