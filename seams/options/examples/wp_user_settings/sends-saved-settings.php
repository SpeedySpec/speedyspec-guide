<?php
// On an admin screen, the saved settings are sent as the cookie when the browser has none.
define( 'WP_ADMIN', true );
wp_set_current_user( 1 );
update_user_option( 1, 'user-settings', 'editor=html', false );
wp_user_settings();
return $_COOKIE['wp-settings-1'];
