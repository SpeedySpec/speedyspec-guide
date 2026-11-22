<?php
// The uploads folder before upload_dir filters it: upload_path and upload_url_path, else wp-content/uploads, with the year/month subdir when uploads are organized by date.
update_option( 'uploads_use_yearmonth_folders', 1 );
$dir = _wp_upload_dir( '2026/03' );
return array( $dir['url'], $dir['subdir'] );
