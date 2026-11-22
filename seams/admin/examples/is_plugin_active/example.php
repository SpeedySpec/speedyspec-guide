<?php
// Whether a plugin is active on the site or across the network, by its main file.
activate_plugin( 'hello.php' );
return array( is_plugin_active( 'hello.php' ), is_plugin_active( 'akismet/akismet.php' ) );
