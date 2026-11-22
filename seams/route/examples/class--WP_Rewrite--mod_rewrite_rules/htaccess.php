<?php
// The .htaccess block: RewriteEngine, the base, index.php itself, external rules, and the front controller; mod_rewrite_rules filters it. With plain permalinks, ''.
$plain = $GLOBALS['wp_rewrite']->mod_rewrite_rules();
$r = guide_permalinks( '/%postname%/' );
$r->add_external_rule( 'feeds/?$', 'feed.php' );
return array( $plain, $r->mod_rewrite_rules() );
