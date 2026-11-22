<?php
// Prints the form confirming the deletion of users from the network, asking whom their posts go to on each site.
$user = wpmu_create_user( 'grace', 'a strong password', 'grace@example.org' );
return str_contains( guide_render( fn() => confirm_delete_users( array( $user ) ) ), 'grace' );
