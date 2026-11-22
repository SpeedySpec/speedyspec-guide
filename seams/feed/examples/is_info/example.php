<?php
// Whether an HTTP status code is informational, 100 to 199. Part of MagpieRSS, deprecated since 3.0.
require_once ABSPATH . WPINC . '/rss.php';
return array( is_info( 101 ), is_info( 200 ) );
