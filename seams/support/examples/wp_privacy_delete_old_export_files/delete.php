<?php
// Deletes export files older than three days (wp_privacy_export_expiration) from the exports folder.
return file_exists( wp_privacy_exports_dir() ) ? 'checked' : ( wp_privacy_delete_old_export_files() ?? 'no exports folder' );
