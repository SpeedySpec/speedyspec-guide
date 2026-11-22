<?php
// Checks a sign-up's username and email: lowercase letters and digits, 4 to 60 characters, not all digits or reserved, and neither taken nor pending; wpmu_validate_user_signup filters the result.
$ok = wpmu_validate_user_signup( 'newuser', 'new@example.org' );
$bad = wpmu_validate_user_signup( 'Ad', 'admin@example.org' );
return array( $ok['errors']->has_errors(), $bad['errors']->get_error_codes() );
