<?php
// Schedules updating the network counts twice a day, on the main site, unless it is scheduled or WordPress is installing.
wp_schedule_update_network_counts();
return wp_get_schedule( 'update_network_counts' );
