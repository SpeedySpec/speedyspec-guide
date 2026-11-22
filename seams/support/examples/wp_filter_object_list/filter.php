<?php
// The items of a list of arrays or objects whose fields match the arguments (all, any or none of them), optionally only one field of each.
$list = array( array( 'n' => 'a', 't' => 'x' ), array( 'n' => 'b', 't' => 'y' ), array( 'n' => 'c', 't' => 'x' ) );
return array( wp_filter_object_list( $list, array( 't' => 'x' ), 'and', 'n' ), wp_filter_object_list( $list, array( 't' => 'x' ), 'not', 'n' ) );
