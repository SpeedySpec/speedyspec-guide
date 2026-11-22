<?php
// The arrow a Query Pagination link shows, by the block's paginationArrow context: none, arrow or chevron.
$block = new WP_Block( array( 'blockName' => 'core/query-pagination-next' ), array( 'paginationArrow' => 'chevron' ) );
return get_query_pagination_arrow( $block, true );
