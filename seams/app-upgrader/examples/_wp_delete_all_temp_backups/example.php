<?php
// Deletes the temporary backups updates leave in wp-content/upgrade-temp-backup, through $wp_filesystem.
$backup = WP_CONTENT_DIR . '/upgrade-temp-backup/plugins/guide-old';
wp_mkdir_p( $backup );
file_put_contents( "$backup/old.php", '<?php' );
_wp_delete_all_temp_backups();
$deleted = ! file_exists( $backup );
rmdir( WP_CONTENT_DIR . '/upgrade-temp-backup' );
return $deleted;
