<?php
// Defines the cookie paths from the network's path, and the cookie domain on subdomain networks.
ms_cookie_constants();
return array( COOKIEPATH, SITECOOKIEPATH, ADMIN_COOKIE_PATH, defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : null );
