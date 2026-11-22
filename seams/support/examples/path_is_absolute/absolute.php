<?php
// Whether a path is absolute: starting with a slash, a Windows drive or a stream wrapper.
return array( path_is_absolute( '/var/www' ), path_is_absolute( 'C:\\www' ), path_is_absolute( 'wp-content' ), path_is_absolute( 'php://memory' ) );
