<?php
// The JOIN and WHERE clauses for a meta query on a table, through WP_Meta_Query.
$sql = get_meta_sql( array( array( 'key' => 'color', 'value' => 'red' ) ), 'post', $GLOBALS['wpdb']->posts, 'ID' );
return array( trim( $sql['join'] ), trim( preg_replace( '/\s+/', ' ', $sql['where'] ) ) );
