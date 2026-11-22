<?php
// A theme's files of some types, to a depth, keyed by relative path, from the child and optionally the parent.
$files = wp_get_theme( 'twentytwentyone' )->get_files( 'php', 0 );
ksort( $files );
return array_slice( array_keys( $files ), 0, 5 );
