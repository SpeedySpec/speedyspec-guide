<?php
// Emails a new user the welcome text with their login details, unless wpmu_welcome_user_notification says no.
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
return wpmu_welcome_user_notification( $grace, 'secret' );
