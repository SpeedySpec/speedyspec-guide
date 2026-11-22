<?php
// Schedules the hourly cleanup of personal data requests, unless it is scheduled or WordPress is installing.
wp_schedule_personal_data_cleanup_requests();
return wp_get_schedule( 'wp_privacy_personal_data_cleanup_requests' );
