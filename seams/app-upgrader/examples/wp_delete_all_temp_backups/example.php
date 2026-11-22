<?php
// Schedules the removal of the temporary backups updates leave in wp-content/upgrade-temp-backup, on shutdown.
wp_delete_all_temp_backups();
return has_action( 'shutdown', '_wp_delete_all_temp_backups' );
