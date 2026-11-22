<?php
// Without the list style, links are separated by the separator, or a <br />; a name list_cats empties is skipped; category_description gives the title.
$cats = array( (object) array( 'term_id' => 1, 'name' => 'News', 'parent' => 0, 'taxonomy' => 'category', 'description' => '<b>All</b> news' ), (object) array( 'term_id' => 2, 'name' => 'Hidden', 'parent' => 0, 'taxonomy' => 'category', 'description' => '' ) );
add_filter( 'list_cats', fn( $name ) => 'Hidden' === $name ? '' : $name );
add_filter( 'category_description', fn( $d ) => $d . '!' );
return array( ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'none', 'use_desc_for_title' => true ) ), ( new Walker_Category() )->walk( $cats, 0, array( 'style' => 'none', 'use_desc_for_title' => false, 'separator' => ',' ) ) );
