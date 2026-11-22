<?php
// Takes a user off a site (their roles there), moving their primary site elsewhere and their posts to another user when asked; fires remove_user_from_blog.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
add_user_to_blog( $site, $grace, 'author' );
add_action( 'remove_user_from_blog', fn( $user, $blog ) => print( "remove_user_from_blog $user $blog\n" ), 10, 2 );
remove_user_from_blog( $grace, $site );
return is_user_member_of_blog( $grace, $site );
