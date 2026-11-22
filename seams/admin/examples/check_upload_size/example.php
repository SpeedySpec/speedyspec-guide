<?php
// Hooked to wp_handle_upload_prefilter on a network: refuses an upload larger than the site's limit or its free space.
return check_upload_size( array( 'name' => 'big.zip', 'size' => 2000 * MB_IN_BYTES, 'tmp_name' => '/tmp/big', 'error' => '0' ) )['error'];
