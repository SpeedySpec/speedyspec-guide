<?php
// Gives a user a role on a site, making it their primary site when they had none; fires add_user_to_blog. can_add_user_to_blog can refuse with an error.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
add_action( 'add_user_to_blog', fn( $user, $role, $blog ) => print( "add_user_to_blog $user $role $blog\n" ), 10, 3 );
add_user_to_blog( $site, $grace, 'editor' );
return array( is_user_member_of_blog( $grace, $site ), get_user_meta( $grace, 'primary_blog', true ) );
