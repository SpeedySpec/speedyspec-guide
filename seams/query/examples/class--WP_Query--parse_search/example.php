<?php
// Search: the s variable is split into terms (quoted phrases kept, stopwords and short words dropped, -term excluded), each matched in titles, excerpts and content, with results ordered by relevance.
$q = new WP_Query();
$q->parse_query( array( 's' => 'red "big apple" -green the' ) );
global $wpdb;
$where = ( fn() => $this->parse_search( $this->query_vars ) )->call( $q );
return array( $q->query_vars['search_terms'], str_contains( $where, 'NOT LIKE' ), in_array( 'the', ( fn() => $this->get_search_stopwords() )->call( $q ), true ) );
