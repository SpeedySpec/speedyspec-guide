<?php
// wp_sprintf_l filters the separators.
add_filter( 'wp_sprintf_l', fn( $l ) => array( 'between' => ' / ', 'between_last_two' => ' & ', 'between_only_two' => ' + ' ) );
return wp_sprintf_l( '%l', array( 'a', 'b', 'c' ) );
