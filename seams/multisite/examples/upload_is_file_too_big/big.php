<?php
// Refuses an upload larger than the network's fileupload_maxk, as an error message in place of the upload; passes it on otherwise.
update_site_option( 'fileupload_maxk', 1 );
return array( upload_is_file_too_big( array( 'bits' => str_repeat( 'x', 4096 ) ) ), upload_is_file_too_big( array( 'bits' => 'x' ) ) );
