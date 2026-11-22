<?php
// Whether an HTTP status code is an error, 400 to 599. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_error( 404 ), is_error( 503 ), is_error( 302 ) );
