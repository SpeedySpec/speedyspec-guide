<?php
// A list sorted by one or more fields, ascending or descending, keys kept when asked.
$list = array( array( 'n' => 'b', 'v' => 2 ), array( 'n' => 'a', 'v' => 2 ), array( 'n' => 'c', 'v' => 1 ) );
return wp_list_pluck( wp_list_sort( $list, array( 'v' => 'DESC', 'n' => 'ASC' ) ), 'n' );
