<?php
// Hooked to import_upload_size_limit on a network: limits an import's upload to the site's free space.
return fix_import_form_size( 50 * MB_IN_BYTES ) > 0;
