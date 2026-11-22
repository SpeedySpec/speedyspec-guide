<?php
// A writable folder for temporary files: WP_TEMP_DIR, PHP's temporary folder, or wp-content; with a trailing slash.
return str_ends_with( get_temp_dir(), '/' ) && wp_is_writable( get_temp_dir() );
