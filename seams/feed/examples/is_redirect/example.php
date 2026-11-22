<?php
// Whether an HTTP status code is a redirect, 300 to 399. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_redirect( 301 ), is_redirect( 200 ) );
