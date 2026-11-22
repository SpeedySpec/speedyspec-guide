<?php
// One field from each item of a list, optionally keyed by another field.
$list = array( array( 'id' => 7, 'n' => 'a' ), (object) array( 'id' => 9, 'n' => 'b' ) );
return array( wp_list_pluck( $list, 'n' ), wp_list_pluck( $list, 'n', 'id' ) );
