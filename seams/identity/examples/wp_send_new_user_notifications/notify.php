<?php
// Sends the new-user emails: to the admin, the user, or both.
$grace = guide_user();
wp_send_new_user_notifications( $grace, 'both' );
return null;
