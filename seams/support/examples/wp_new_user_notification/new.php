<?php
// Emails a new user's details: to the admin, and to the user with a link to set their password; notify picks admin, user or both.
$grace = guide_user();
wp_new_user_notification( $grace, null, 'both' );
return 'done';
