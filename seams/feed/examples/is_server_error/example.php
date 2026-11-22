<?php
// Whether an HTTP status code is a server error, 500 to 599. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_server_error( 503 ), is_server_error( 404 ) );
