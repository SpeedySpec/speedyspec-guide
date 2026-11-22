<?php
// The REST URL of a site and path: home URL plus the prefix with pretty permalinks, else ?rest_route=; filtered by rest_url.
$plain = get_rest_url( null, '/wp/v2/posts' );
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, get_rest_url( null, '/wp/v2/posts' ) );
