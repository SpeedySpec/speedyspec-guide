<?php
// Deprecated in 2.9.0. Gave the full path of a theme or plugin file for the file editor.
list( $result, $notice ) = guide_deprecated( 'get_real_file_to_edit', 'style.css' );
return array( str_replace( WP_CONTENT_DIR, 'WP_CONTENT_DIR', $result ), $notice );
