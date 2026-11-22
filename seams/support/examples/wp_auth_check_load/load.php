<?php
// Loads the login check scripts and styles in the admin for logged-in users, so an expired session shows a login dialog; wp_auth_check_load filters it.
set_current_screen( 'dashboard' );
wp_auth_check_load();
return array( wp_script_is( 'wp-auth-check', 'enqueued' ), has_action( 'admin_print_footer_scripts', 'wp_auth_check_html' ) );
