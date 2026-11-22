<?php
// The block categories for an editor context; filtered by block_categories_all.
add_filter( 'block_categories_all', 'guide_add_category' );
function guide_add_category( $categories ) {
	$categories[] = array( 'slug' => 'guide', 'title' => 'Guide' );
	return $categories;
}
return array_column( get_block_categories( new WP_Block_Editor_Context() ), 'slug' );
