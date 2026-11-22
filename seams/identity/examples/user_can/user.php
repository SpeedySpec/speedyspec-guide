<?php
// Whether a user (by ID or object) has a capability; user_can_for_site() checks on a site of a network.
$grace = guide_user();
return array( user_can( $grace, 'edit_others_posts' ), user_can( $grace, 'manage_options' ), user_can( get_userdata( 1 ), 'manage_options' ), user_can( 999, 'read' ), user_can_for_site( $grace, 1, 'edit_posts' ) );
