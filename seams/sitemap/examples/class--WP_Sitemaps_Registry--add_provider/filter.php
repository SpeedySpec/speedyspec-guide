<?php
// wp_sitemaps_add_provider can replace a provider, or refuse it by returning anything else; get_provider() needs a registered name.
add_filter( 'wp_sitemaps_add_provider', fn( $p, $name ) => 'users' === $name ? false : $p, 10, 2 );
$registry = new WP_Sitemaps_Registry();
return array( $registry->add_provider( 'posts', new WP_Sitemaps_Posts() ), $registry->add_provider( 'users', new WP_Sitemaps_Users() ), array_keys( $registry->get_providers() ), $registry->get_provider( 'users' ), $registry->get_provider( 5 ) );
