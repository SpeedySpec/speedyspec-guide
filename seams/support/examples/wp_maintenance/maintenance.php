<?php
// Shows the maintenance page and ends the request while the site is in maintenance mode (a recent .maintenance file in ABSPATH); otherwise nothing.
wp_maintenance();
return 'not in maintenance';
