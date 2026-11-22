<?php
// Hooks a callback to activate_{plugin basename}, which activate_plugin() fires.
register_activation_hook( WP_PLUGIN_DIR . '/shop/shop.php', 'guide_on_activate' );
function guide_on_activate() { echo "activated\n"; }
do_action( 'activate_shop/shop.php' );
return has_action( 'activate_shop/shop.php', 'guide_on_activate' );
