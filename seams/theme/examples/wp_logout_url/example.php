<?php
// The log out URL with its nonce and a redirect; filtered by logout_url.
return preg_replace( '/_wpnonce=\w+/', '_wpnonce=X', wp_logout_url( home_url( '/bye' ) ) );
