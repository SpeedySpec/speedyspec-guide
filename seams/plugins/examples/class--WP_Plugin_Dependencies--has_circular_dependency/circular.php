<?php
// Plugins that require each other, directly or through others, have a circular dependency.
WP_Plugin_Dependencies::initialize();
return array( WP_Plugin_Dependencies::has_circular_dependency( 'ping/ping.php' ), WP_Plugin_Dependencies::has_circular_dependency( 'pong/pong.php' ), WP_Plugin_Dependencies::has_circular_dependency( 'shop/shop.php' ), guide_call( 'WP_Plugin_Dependencies', 'get_circular_dependencies' ) );
