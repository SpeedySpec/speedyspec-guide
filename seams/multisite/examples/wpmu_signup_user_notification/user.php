<?php
// Emails a user sign-up its activation link; wpmu_signup_user_notification can stop it, and its subject and text are filtered.
return wpmu_signup_user_notification( 'newbie', 'newbie@example.org', 'abc123' );
