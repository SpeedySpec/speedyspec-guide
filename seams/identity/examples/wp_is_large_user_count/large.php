<?php
// Whether the site has over 10,000 users, the point where user lists stop counting; wp_is_large_user_count filters it.
function guide_any_user_count_is_large( $is_large, $count ) {
	return $count > 0;
}
add_filter( 'wp_is_large_user_count', 'guide_any_user_count_is_large', 10, 2 );
return wp_is_large_user_count();
