<?php
// The options of a category dropdown: list_cats filters each name, show_count adds the count.
$cats = array( (object) array( 'term_id' => 1, 'name' => 'News', 'parent' => 0, 'count' => 1200, 'taxonomy' => 'category', 'description' => '' ), (object) array( 'term_id' => 2, 'name' => 'Local', 'parent' => 1, 'count' => 3, 'taxonomy' => 'category', 'description' => '' ) );
function guide_uppercase_category( $name ) {
	return strtoupper( $name );
}
add_filter( 'list_cats', 'guide_uppercase_category' );
return ( new Walker_CategoryDropdown() )->walk( $cats, 0, array( 'selected' => '2', 'show_count' => true ) );
