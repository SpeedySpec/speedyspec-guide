<?php
// Deletes a user's sign-up rows when the user is deleted.
wpmu_signup_user( 'newbie', 'newbie@example.org' );
global $wpdb;
$key = $wpdb->get_var( "SELECT activation_key FROM {$wpdb->signups} WHERE user_login = 'newbie'" );
$user = wpmu_activate_signup( $key )['user_id'];
wp_delete_signup_on_user_delete( $user, null, get_userdata( $user ) );
return $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->signups} WHERE user_login = 'newbie'" );
