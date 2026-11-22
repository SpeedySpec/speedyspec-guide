<?php
// Defines the upload constants of networks that rewrite files through ms-files.php (UPLOADBLOGSDIR, UPLOADS, BLOGUPLOADDIR), as networks do while the ms_files_rewriting option is unset; nothing once it is off.
ms_upload_constants();
return array( (bool) get_site_option( 'ms_files_rewriting' ), UPLOADBLOGSDIR );
