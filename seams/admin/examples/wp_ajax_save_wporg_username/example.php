<?php
// Ajax handler that saves the WordPress.org username used for the favorites tabs of the plugin and theme installers.
$user = get_current_user_id();
guide_ajax( 'wp_ajax_save_wporg_username', array( 'username' => 'ada' ), "save_wporg_username_$user" );
return get_user_meta( $user, 'wporg_favorites', true );
