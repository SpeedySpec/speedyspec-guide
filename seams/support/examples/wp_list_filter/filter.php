<?php
// The items of a list whose fields match the arguments; and, or or not.
$list = array( (object) array( 'n' => 'a', 't' => 'x' ), (object) array( 'n' => 'b', 't' => 'y' ) );
return count( wp_list_filter( $list, array( 't' => 'y' ) ) );
