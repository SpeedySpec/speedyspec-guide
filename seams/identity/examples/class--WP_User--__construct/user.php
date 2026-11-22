<?php
// A user loaded by ID, login or row, with its roles and capabilities for the current site; data holds the user row, and meta reads through magic properties. get_role_caps(), add_role(), set_role(), add_cap() and has_cap() manage its access.
$grace = guide_user();
$user = new WP_User( $grace );
$by_login = new WP_User( 0, 'grace' );
$user->add_role( 'author' );
$user->add_cap( 'moderate_comments', false );
$roles = $user->roles;
$user->set_role( 'subscriber' );
return array( $by_login->ID === $grace, $user->exists(), $roles, $user->roles, $user->has_cap( 'edit_posts' ), $user->has_cap( 'read' ), $user->nickname, isset( $user->nickname ), $user->get_site_id(), ( new WP_User( 999 ) )->exists() );
