<?php
// Adds a role with a display name and capabilities; an existing role or a name or slug left empty is refused.
function guide_print_doing_it_wrong( $function_name ) {
	echo "doing_it_wrong_run $function_name\n";
}
add_action( 'doing_it_wrong_run', 'guide_print_doing_it_wrong' );
$role = add_role( 'reviewer', 'Reviewer', array( 'read' => true, 'edit_posts' => true ) );
return array( get_class( $role ), $role->capabilities, add_role( 'reviewer', 'Again' ), add_role( '', 'Empty' ) );
