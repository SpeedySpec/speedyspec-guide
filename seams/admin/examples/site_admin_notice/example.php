<?php
// Prints the notice to network admins that the network needs upgrading after a WordPress update.
update_site_option( 'wpmu_upgrade_site', 1 );
return str_contains( guide_render( 'site_admin_notice' ), 'upgrade.php' );
