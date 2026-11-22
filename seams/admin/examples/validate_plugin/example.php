<?php
// Checks a plugin file exists and is in the installed plugins list; 0 or an error.
return array( validate_plugin( 'hello.php' ), validate_plugin( 'nope.php' )->get_error_code() );
