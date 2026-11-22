<?php
// Without the list style, links are separated by the separator, or a <br />; a name list_cats empties is skipped; category_description gives the title.
$cats = array( (object) array( 'term_id' => 1, 'name' => 'News', 'parent' => 0, 'taxonomy' => 'category', 'description' => '<b>All</b> news' ), (object) array( 'term_id' => 2, 'name' => 'Hidden', 'parent' => 0, 'taxonomy' => 'category', 'description' => '' ) );
function guide_hide_category( $name ) {
	return 'Hidden' === $name ? '' : $name;
}
add_filter( 'list_cats', 'guide_hide_category' );
function guide_mark_description( $description ) {
	return $description . '!';
}
add_filter( 'category_description', 'guide_mark_description' );
return array( ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'none', 'use_desc_for_title' => true ) ), ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'none', 'use_desc_for_title' => false, 'separator' => ',' ) ) );
