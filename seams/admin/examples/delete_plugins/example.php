<?php
// Deletes plugins' files through $wp_filesystem, running their uninstall routines first; true, false or an error.
$result = delete_plugins( array( 'nope/nope.php' ) );
return is_wp_error( $result ) ? $result->get_error_code() : $result;
