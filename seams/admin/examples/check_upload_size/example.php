<?php
// Hooked to wp_handle_upload_prefilter on a network: refuses an upload larger than the network's file size limit or the site's free space, unless the network turned the check off.
update_site_option( 'upload_space_check_disabled', 0 );
$tmp = wp_tempnam( 'big.zip' );
file_put_contents( $tmp, str_repeat( 'x', 2 * MB_IN_BYTES ) );
$file = check_upload_size( array( 'name' => 'big.zip', 'tmp_name' => $tmp, 'error' => 0 ) );
unlink( $tmp );
return $file['error'];
