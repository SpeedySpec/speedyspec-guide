<?php
// Adds a new user to the site they signed up on, with its default role, when activation gives the site; on wpmu_activate_user.
$site = wp_insert_site( array( 'domain' => 'example.org', 'path' => '/second/', 'title' => 'Second' ) );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
add_new_user_to_blog( $grace, 'secret', array( 'add_to_blog' => $site, 'new_role' => 'author' ) );
return is_user_member_of_blog( $grace, $site );
