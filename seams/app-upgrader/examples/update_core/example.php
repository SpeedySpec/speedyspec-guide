<?php
// Finishes a core update: copies the new files from the unpacked package over WordPress, removes old files, runs the database upgrade; gives the new version or an error.
WP_Filesystem();
$result = update_core( get_temp_dir() . 'guide-no-package/', ABSPATH );
return $result->get_error_code();
