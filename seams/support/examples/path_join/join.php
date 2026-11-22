<?php
// Joins a base and a path, unless the path is already absolute.
return array( path_join( '/var/www/', 'wp-content' ), path_join( '/var/www', '/etc/hosts' ) );
