<?php
// Switches to a user's locale; for a user without one, the site's, which is no switch.
return array( switch_to_user_locale( 0 ), is_locale_switched() );
