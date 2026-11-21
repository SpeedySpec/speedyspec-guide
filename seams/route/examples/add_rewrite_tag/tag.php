<?php
// A tag stands for a regex in structures and its query var; without a query, the query var is the tag's name and is made public. A name not wrapped in % is ignored.
add_rewrite_tag( '%guide%', '([^/]+)' );
add_rewrite_tag( '%topic%', '([0-9]+)', 'cat=' );
add_rewrite_tag( 'bad', 'x' );
$r = $GLOBALS['wp_rewrite'];
return array( array_slice( $r->rewritecode, -2 ), array_slice( $r->rewritereplace, -2 ), array_slice( $r->queryreplace, -2 ), in_array( 'guide', $GLOBALS['wp']->public_query_vars, true ) );
