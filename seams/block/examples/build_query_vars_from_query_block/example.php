<?php
// WP_Query arguments from a Query Loop block's query attribute and page: post type, per page, offset, order, terms, author, search and sticky handling.
$block = new WP_Block( array( 'blockName' => 'core/post-template' ), array( 'query' => array( 'postType' => 'post', 'perPage' => 3, 'order' => 'asc', 'orderBy' => 'title', 'search' => 'hi', 'sticky' => 'exclude' ) ) );
$vars = build_query_vars_from_query_block( $block, 2 );
return array( $vars['post_type'], $vars['posts_per_page'], $vars['offset'], $vars['order'], $vars['orderby'], $vars['s'] );
