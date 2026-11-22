<?php
// Whether a path can be written to, found by writing a temporary file in it, for Windows, where is_writable() is unreliable.
$dir = sys_get_temp_dir() . '/';
return array( win_is_writable( $dir ), win_is_writable( '/nonexistent/dir/' ) );
