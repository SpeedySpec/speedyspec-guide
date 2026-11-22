<?php
// Finds a loop in a chain of parents with Floyd's tortoise and hare: an item in the loop, or every item in it when asked; false when there is none.
$parents = array( 1 => 2, 2 => 3, 3 => 1 );
$parent_of = fn( $id ) => $parents[ $id ] ?? 0;
return array( wp_find_hierarchy_loop_tortoise_hare( $parent_of, 1, array(), array(), true ), wp_find_hierarchy_loop_tortoise_hare( fn( $id ) => 0, 1 ) );
