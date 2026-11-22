<?php
// Deprecated in 3.7.0; use new Plugin_Upgrader();. Started a plugin update, now with Plugin_Upgrader.
$result = wp_update_plugin( 'hello.php' );
return is_wp_error( $result ) ? $result->get_error_code() : $result;
