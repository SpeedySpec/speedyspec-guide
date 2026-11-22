<?php
// Whether a user has a capability on a site; on a single site, the site itself.
$grace = guide_user();
return array( user_can_for_site( $grace, 1, 'moderate_comments' ), user_can_for_site( $grace, 1, 'install_plugins' ) );
