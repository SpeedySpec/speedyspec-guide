<?php
// Sets up the global $wp_filesystem with the filesystem method WordPress can use (direct, SSH2, FTP or FTP sockets) and connects it; false when credentials are missing.
$connected = WP_Filesystem();
return array( $connected, get_class( $GLOBALS['wp_filesystem'] ), $GLOBALS['wp_filesystem']->method );
