<?php
// Whether an HTTP status code means success, 200 to 299. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_success( 200 ), is_success( 304 ), is_success( 404 ) );
