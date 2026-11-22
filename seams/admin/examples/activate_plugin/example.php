<?php
// Activates a plugin: checks it is valid and its requirements, loads it, runs its activation hook and adds it to active_plugins; null or an error.
$result = activate_plugin( 'hello.php' );
return array( $result, get_option( 'active_plugins' ), activate_plugin( 'nope.php' )->get_error_code() );
