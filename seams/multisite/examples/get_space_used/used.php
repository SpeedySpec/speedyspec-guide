<?php
// The megabytes the site's uploads use, from its uploads folder; pre_get_space_used can answer.
function guide_space_used( $space_used ) {
	return 12.5;
}
add_filter( 'pre_get_space_used', 'guide_space_used' );
return get_space_used();
