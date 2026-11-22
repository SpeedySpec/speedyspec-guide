<?php
// Whether a user is a super admin; on a single site, an administrator (who can delete users).
$grace = guide_user();
return array( is_super_admin(), is_super_admin( 1 ), is_super_admin( $grace ) );
