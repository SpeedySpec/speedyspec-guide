<?php
// Makes a user a super admin of the network; on a single site, or for a user already one, false.
$grace = guide_user();
return array( grant_super_admin( $grace ), revoke_super_admin( 1 ) );
