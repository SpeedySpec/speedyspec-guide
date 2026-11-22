<?php
// Records a user sign-up in the signups table with an activation key and emails the confirmation (through after_signup_user).
wpmu_signup_user( 'newbie', 'newbie@example.org' );
global $wpdb;
return $wpdb->get_row( "SELECT user_login, user_email, active FROM {$wpdb->signups} WHERE user_login = 'newbie'", ARRAY_A );
