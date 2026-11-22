<?php
// Adds an invited user to a site with a role, firing added_existing_user; nothing without details.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
switch_to_blog( $site );
function guide_print_added_existing_user( $user ) {
	echo "added_existing_user $user\n";
}
add_action( 'added_existing_user', 'guide_print_added_existing_user' );
add_existing_user_to_blog( array( 'user_id' => $grace, 'role' => 'author' ) );
$member = is_user_member_of_blog( $grace );
restore_current_blog();
return array( $member, add_existing_user_to_blog() );
