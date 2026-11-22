<?php
// Whether the request is for an admin screen (the current screen, else WP_ADMIN); AJAX requests count as admin.
return array( is_admin(), defined( 'WP_ADMIN' ) );
