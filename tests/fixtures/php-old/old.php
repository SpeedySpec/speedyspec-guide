<?php
function old_first_char( $s ) {
	return $s{0};
}

function old_by_ref() {
	$q =& new WP_Query();
	return $q;
}
