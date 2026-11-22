<?php
// On the main site, schedules the twice-daily user count update unless it is already scheduled.
wp_schedule_update_user_counts();
return array( (bool) wp_next_scheduled( 'wp_update_user_counts' ), wp_get_schedule( 'wp_update_user_counts' ) );
