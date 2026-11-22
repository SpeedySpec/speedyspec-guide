<?php
// Prints a notice when a core update failed and left the site in maintenance, telling admins to try again.
update_option( 'update_core_last_failed', time() );
$GLOBALS['upgrading'] = time() - 20 * MINUTE_IN_SECONDS;
return guide_render( 'maintenance_nag' );
