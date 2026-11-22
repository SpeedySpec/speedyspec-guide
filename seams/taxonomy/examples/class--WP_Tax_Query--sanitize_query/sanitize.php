<?php
// Clauses get defaults (field term_id, operator IN, include_children true), the relation is AND or OR (AND otherwise), and nested queries are kept.
$query = new WP_Tax_Query( array( 'relation' => 'xor', array( 'taxonomy' => 'category', 'terms' => 3 ) ) );
return array( $query->relation, $query->queries[0], $query->sanitize_relation( 'or' ), $query->sanitize_relation( 'nope' ) );
