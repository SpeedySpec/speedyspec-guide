<?php
// Adds a role with a display name and capabilities; an existing role or a name or slug left empty is refused.
add_action( 'doing_it_wrong_run', fn( $f ) => print( "doing_it_wrong_run $f\n" ) );
$role = add_role( 'reviewer', 'Reviewer', array( 'read' => true, 'edit_posts' => true ) );
return array( get_class( $role ), $role->capabilities, add_role( 'reviewer', 'Again' ), add_role( '', 'Empty' ) );
