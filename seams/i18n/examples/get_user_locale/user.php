<?php
// A user's locale from their profile, or the site's when they have none (or nobody is logged in).
return array( get_user_locale(), get_user_locale( 0 ) );
