<?php
// The users controller: users at /wp/v2/users and the current user at /wp/v2/users/me, listed, read, created, updated and deleted; visitors see only users who have published posts.
[ $status, $user ] = guide_rest( 'POST', '/wp/v2/users', array( 'username' => 'grace', 'email' => 'grace@example.org', 'password' => 'secret-pass', 'roles' => array( 'editor' ) ) );
$me = guide_rest( 'GET', '/wp/v2/users/me' )[1];
wp_set_current_user( 0 );
return array( $status, $user['roles'], $me['slug'], guide_rest( 'GET', '/wp/v2/users/me' )[0], count( guide_rest( 'GET', '/wp/v2/users' )[1] ) );
