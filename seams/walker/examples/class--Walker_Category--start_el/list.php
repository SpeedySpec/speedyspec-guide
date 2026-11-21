<?php
// A category list: with plain permalinks a category links to ?cat=ID; category_list_link_attributes and category_css_class filter the link and the classes.
$cats = array( (object) array( 'term_id' => 1, 'name' => 'News', 'parent' => 0, 'count' => 1200, 'taxonomy' => 'category', 'description' => '' ), (object) array( 'term_id' => 2, 'name' => 'Local', 'parent' => 1, 'count' => 3, 'taxonomy' => 'category', 'description' => '' ) );
add_filter( 'category_list_link_attributes', fn( $atts, $cat ) => $atts + array( 'data-id' => $cat->term_id ), 10, 2 );
add_filter( 'category_css_class', fn( $classes ) => array_merge( $classes, array( 'x' ) ) );
return ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'list', 'use_desc_for_title' => false, 'show_count' => true ) );
