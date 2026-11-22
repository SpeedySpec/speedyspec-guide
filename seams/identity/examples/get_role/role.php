<?php
// A role as a WP_Role, or null.
$editor = get_role( 'editor' );
return array( get_class( $editor ), $editor->has_cap( 'edit_others_posts' ), $editor->has_cap( 'manage_options' ), get_role( 'nope' ) );
