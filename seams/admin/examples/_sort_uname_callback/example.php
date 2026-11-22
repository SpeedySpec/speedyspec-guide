<?php
// Sorts plugins by name, case-insensitively, for get_plugins().
$plugins = array( 'b.php' => array( 'Name' => 'banana' ), 'a.php' => array( 'Name' => 'Apple' ) );
uasort( $plugins, '_sort_uname_callback' );
return array_keys( $plugins );
