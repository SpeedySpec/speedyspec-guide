<?php
// Drops a path and its parent folders from the folder size cache, so their sizes are worked out again.
set_transient( 'dirsize_cache', array( '/a' => 1, '/a/b' => 2, '/c' => 3 ) );
clean_dirsize_cache( '/a/b' );
return get_transient( 'dirsize_cache' );
