<?php
// Hooked to init: schedules the twice-daily core, plugin and theme update checks unless installing.
wp_clear_scheduled_hook( 'wp_version_check' );
wp_schedule_update_checks();
return array( wp_get_schedule( 'wp_version_check' ), wp_get_schedule( 'wp_update_plugins' ), wp_get_schedule( 'wp_update_themes' ) );
