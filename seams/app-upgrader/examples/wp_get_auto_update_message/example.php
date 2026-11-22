<?php
// The text telling when automatic updates next run for plugins or themes, from the scheduled update check.
wp_schedule_event( time() + HOUR_IN_SECONDS, 'twicedaily', 'wp_version_check' );
return wp_get_auto_update_message();
