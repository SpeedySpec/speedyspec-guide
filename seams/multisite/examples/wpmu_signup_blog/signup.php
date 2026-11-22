<?php
// Records a site sign-up in the signups table with an activation key and emails the confirmation (through wpmu_signup_blog_notification on after_signup_site).
wpmu_signup_blog( 'example.org', '/team/', 'Team', 'teamlead', 'lead@example.org' );
global $wpdb;
return $wpdb->get_row( "SELECT domain, path, title, user_login, active FROM {$wpdb->signups} WHERE user_login = 'teamlead'", ARRAY_A );
