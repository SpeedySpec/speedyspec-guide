<?php
// A category list: with plain permalinks a category links to ?cat=ID; category_list_link_attributes and category_css_class filter the link and the classes.
$cats = array( (object) array( 'term_id' => 1, 'name' => 'News', 'parent' => 0, 'count' => 1200, 'taxonomy' => 'category', 'description' => '' ), (object) array( 'term_id' => 2, 'name' => 'Local', 'parent' => 1, 'count' => 3, 'taxonomy' => 'category', 'description' => '' ) );
function guide_add_category_id( $atts, $category ) {
	return $atts + array( 'data-id' => $category->term_id );
}
add_filter( 'category_list_link_attributes', 'guide_add_category_id', 10, 2 );
function guide_add_category_class( $classes ) {
	return array_merge( $classes, array( 'x' ) );
}
add_filter( 'category_css_class', 'guide_add_category_class' );
return ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'list', 'use_desc_for_title' => false, 'show_count' => true ) );
