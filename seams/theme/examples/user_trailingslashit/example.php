<?php
// Adds or removes the trailing slash of a URL path to match the permalink structure; filtered by user_trailingslashit.
$plain = user_trailingslashit( 'about/' );
update_option( 'permalink_structure', '/%postname%/' );
$GLOBALS['wp_rewrite']->init();
return array( $plain, user_trailingslashit( 'about' ) );
