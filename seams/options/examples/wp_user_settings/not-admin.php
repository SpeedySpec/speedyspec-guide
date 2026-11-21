<?php
// Outside the admin it does nothing.
wp_set_current_user( 1 );
update_user_option( 1, 'user-settings', 'editor=html', false );
wp_user_settings();
return isset( $_COOKIE['wp-settings-1'] );
