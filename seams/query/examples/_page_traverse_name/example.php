<?php
// Walks a page tree, collecting each page's slug by ID; used by get_page_hierarchy().
$children = array( 0 => array( (object) array( 'ID' => 1, 'post_name' => 'a' ) ), 1 => array( (object) array( 'ID' => 2, 'post_name' => 'b' ) ) );
$result = array();
_page_traverse_name( 0, $children, $result );
return $result;
