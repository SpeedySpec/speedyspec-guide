<?php
// Limits the upload size to the network's fileupload_maxk and the space left; on upload_size_limit.
update_site_option( 'fileupload_maxk', 100 );
return upload_size_limit_filter( 1000000 );
