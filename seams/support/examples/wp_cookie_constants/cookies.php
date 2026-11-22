<?php
// Defines the cookie names (from COOKIEHASH, the MD5 of the site URL) and their paths and domain, unless already defined.
wp_cookie_constants();
return array( COOKIEHASH === md5( 'http://example.org' ), LOGGED_IN_COOKIE === 'wordpress_logged_in_' . COOKIEHASH, COOKIEPATH, SITECOOKIEPATH, ADMIN_COOKIE_PATH, COOKIE_DOMAIN );
