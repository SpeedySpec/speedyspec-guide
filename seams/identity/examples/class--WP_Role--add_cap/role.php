<?php
// A role's name and capabilities; add_cap() and remove_cap() change it in the site's roles, and has_cap() checks it (role_has_cap filters the answer).
$role = get_role( 'author' );
$role->add_cap( 'guide_cap' );
$has = $role->has_cap( 'guide_cap' );
$role->remove_cap( 'guide_cap' );
return array( $role->name, $has, $role->has_cap( 'guide_cap' ), get_role( 'author' )->has_cap( 'upload_files' ) );
