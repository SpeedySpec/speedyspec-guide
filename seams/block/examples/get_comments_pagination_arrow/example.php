<?php
// The arrow a Comments Pagination link shows, by the block's commentsPaginationArrow context.
$block = new WP_Block( array( 'blockName' => 'core/comments-pagination-next' ), array( 'comments/paginationArrow' => 'arrow' ) );
return get_comments_pagination_arrow( $block, 'next' );
