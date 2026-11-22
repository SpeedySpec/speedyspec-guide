<?php
// A tax query's JOIN and WHERE clauses: IN, NOT IN, AND, EXISTS and NOT EXISTS operators, terms by ID, slug or name (made into term_taxonomy_ids), children included for hierarchical taxonomies, nested with AND or OR.
$news = wp_insert_term( 'News', 'category' );
$local = wp_insert_term( 'Local', 'category', array( 'parent' => $news['term_id'] ) );
$sport = wp_insert_term( 'Sport', 'category' );
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_category' => array( $local['term_id'] ), 'tags_input' => array( 'alpha' ) ) );
$query = new WP_Tax_Query( array( 'relation' => 'OR', array( 'taxonomy' => 'category', 'field' => 'slug', 'terms' => 'news' ), array( 'taxonomy' => 'post_tag', 'operator' => 'NOT EXISTS' ) ) );
$sql = $query->get_sql( $GLOBALS['wpdb']->posts, 'ID' );
return array( $query->relation, trim( $sql['join'] ), trim( preg_replace( '/\s+/', ' ', $sql['where'] ) ), array_keys( $query->queried_terms ) );
