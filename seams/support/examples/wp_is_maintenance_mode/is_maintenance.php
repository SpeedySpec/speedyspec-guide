<?php
// Whether the site is in maintenance mode: a .maintenance file in ABSPATH setting $upgrading within the last ten minutes, unless enable_maintenance_mode turns it off.
return array( wp_is_maintenance_mode(), file_exists( ABSPATH . '.maintenance' ) );
