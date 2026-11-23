<?php
// Activates several plugins; true, or an error listing those that failed.
$result = activate_plugins( array( 'hello.php', 'nope.php' ) );
return array( $result->get_error_code(), is_plugin_active( 'hello.php' ) );
