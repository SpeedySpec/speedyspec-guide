<?php
// Whether a path can be written to; on Windows it tries writing, as is_writable() can't tell there.
return array( wp_is_writable( sys_get_temp_dir() ), wp_is_writable( '/nonexistent/dir' ) );
