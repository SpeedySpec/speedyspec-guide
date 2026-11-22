<?php
// Deletes a user from the whole network: removes them from every site, reassigning or deleting their posts, and deletes them.
$user = wpmu_create_user( 'grace', 'a strong password', 'grace@example.org' );
return array( wpmu_delete_user( $user ), get_userdata( $user ) );
