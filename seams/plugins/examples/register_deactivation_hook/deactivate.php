<?php
// Hooks a callback to deactivate_{plugin basename}, which deactivate_plugins() fires.
register_deactivation_hook( WP_PLUGIN_DIR . '/shop/shop.php', 'guide_on_deactivate' );
function guide_on_deactivate() { echo "deactivated\n"; }
do_action( 'deactivate_shop/shop.php' );
return has_action( 'deactivate_shop/shop.php', 'guide_on_deactivate' );
