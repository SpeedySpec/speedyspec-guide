<?php
// Emails the site admin that a user changed their password, unless the user is the admin by email.
$grace = guide_user();
wp_password_change_notification( get_userdata( $grace ) );
wp_password_change_notification( get_userdata( 1 ) );
return 'done';
