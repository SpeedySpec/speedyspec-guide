<?php
// Whether the user has a capability: meta capabilities are mapped first, then every required capability must be granted (user_has_cap filters the full set); the user_level_N capabilities follow the user's level.
$grace = guide_user();
$user = new WP_User( $grace );
function guide_grant_extra_cap( $allcaps, $caps, $args, $user ) {
	return $allcaps + array( 'guide_extra' => true );
}
add_filter( 'user_has_cap', 'guide_grant_extra_cap', 10, 4 );
return array( $user->has_cap( 'edit_others_posts' ), $user->has_cap( 'guide_extra' ), $user->has_cap( 'level_7' ), $user->has_cap( 'level_8' ), $user->has_cap( 'manage_options' ) );
