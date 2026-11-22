<?php
// The items in a loop of parents, found from an item and its new parent with a callback that gives each item's parent; empty when there is none.
$parents = array( 1 => 2, 2 => 3, 3 => 0 );
$parent_of = fn( $id ) => $parents[ $id ] ?? 0;
return array( wp_find_hierarchy_loop( $parent_of, 3, 1 ), wp_find_hierarchy_loop( $parent_of, 4, 1 ) );
