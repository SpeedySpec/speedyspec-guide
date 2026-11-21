<?php
// An object member of the input as an array, an empty array when missing, or null when it isn't an object; parse_filter_int() reads whole numbers.
guide_core_abilities();
$content = new WP_Abilities_Content();
return array( guide_private( $content, 'get_input_object', array( 'where' => '' ), 'where' ), guide_private( $content, 'get_input_object', array( 'where' => 5 ), 'where' ), array_map( fn( $v ) => guide_private( $content, 'parse_filter_int', $v, 0 ), array( 0, '+2', '2.0', 2.0, -1 ) ) );
