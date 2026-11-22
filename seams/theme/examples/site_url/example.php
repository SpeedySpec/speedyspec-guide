<?php
// The URL WordPress itself is installed at, with a path and scheme; filtered by site_url.
return array( site_url(), site_url( 'wp-login.php', 'login' ) );
