<?php
// Emails a user that an application password was made for their account, with its name; send_application_password_created_notification can stop it.
wp_application_password_created_notification( 1, array( 'name' => 'Phone app' ) );
return 'done';
