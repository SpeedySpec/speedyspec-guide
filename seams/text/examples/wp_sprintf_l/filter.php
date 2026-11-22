<?php
// wp_sprintf_l filters the separators.
function guide_list_separators( $l ) {
	return array( 'between' => ' / ', 'between_last_two' => ' & ', 'between_only_two' => ' + ' );
}
add_filter( 'wp_sprintf_l', 'guide_list_separators' );
return wp_sprintf_l( '%l', array( 'a', 'b', 'c' ) );
