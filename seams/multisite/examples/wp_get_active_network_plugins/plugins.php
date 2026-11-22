<?php
// The files of the plugins active across the network that exist and end in .php.
update_site_option( 'active_sitewide_plugins', array( 'hello.php' => time(), 'gone/gone.php' => time() ) );
return array_map( 'basename', wp_get_active_network_plugins() );
