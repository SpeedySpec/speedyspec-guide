<?php
// Whether an HTTP status code is a client error, 400 to 499. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_client_error( 404 ), is_client_error( 503 ) );
