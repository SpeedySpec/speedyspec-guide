<?php
// The built-in cache supports the *_multiple functions and flushing the runtime or a group.
$features = array( 'add_multiple', 'set_multiple', 'get_multiple', 'delete_multiple', 'flush_runtime', 'flush_group', 'something_else' );
return array_map( 'wp_cache_supports', $features );
