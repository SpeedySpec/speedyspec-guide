<?php
// Activates a sign-up by its key: creates the user (and site), marks the sign-up active and fires wpmu_activate_user or wpmu_activate_blog; an error for an unknown or used key.
wpmu_signup_user( 'newbie', 'newbie@example.org' );
global $wpdb;
$key = $wpdb->get_var( "SELECT activation_key FROM {$wpdb->signups} WHERE user_login = 'newbie'" );
$done = wpmu_activate_signup( $key );
return array( get_userdata( $done['user_id'] )->user_login, wpmu_activate_signup( $key )->get_error_code(), wpmu_activate_signup( 'nope' )->get_error_code() );
