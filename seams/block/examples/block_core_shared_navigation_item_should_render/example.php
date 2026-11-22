<?php
// Whether a navigation item links to a post that should show: published, or the user may read it.
$published = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'About', 'post_status' => 'publish' ) );
$draft = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Soon', 'post_status' => 'draft' ) );
$block = new WP_Block( parse_blocks( '<!-- wp:navigation-link /-->' )[0] );
return array(
	block_core_shared_navigation_item_should_render( array( 'id' => $published, 'kind' => 'post-type' ), $block ),
	block_core_shared_navigation_item_should_render( array( 'id' => $draft, 'kind' => 'post-type' ), $block ),
);
