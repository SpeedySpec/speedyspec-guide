<?php
// The site's roles, from the {prefix}user_roles option: add_role(), remove_role(), add_cap() and remove_cap() change them and save the option; get_names() gives each role's name.
$roles = wp_roles();
$roles->add_role( 'reviewer', 'Reviewer', array( 'read' => true ) );
$roles->add_cap( 'reviewer', 'edit_posts' );
$caps = $roles->get_role( 'reviewer' )->capabilities;
$roles->remove_cap( 'reviewer', 'read' );
$after = get_option( 'guide_user_roles' )['reviewer']['capabilities'];
$roles->remove_role( 'reviewer' );
return array( $caps, $after, $roles->is_role( 'reviewer' ), $roles->is_role( 'editor' ), $roles->get_names()['author'] );
