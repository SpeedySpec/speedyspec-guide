<?php
// Schedules the hourly deletion of old export files, unless it is scheduled or WordPress is installing.
wp_schedule_delete_old_privacy_export_files();
return wp_get_schedule( 'wp_privacy_delete_old_export_files' );
