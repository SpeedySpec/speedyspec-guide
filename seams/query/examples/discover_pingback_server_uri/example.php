<?php
// Finds a URL's pingback server from its X-Pingback header or its pingback link; false when it has none or can't be fetched.
return discover_pingback_server_uri( 'http://elsewhere.test/post' );
