<?php
// Initializing hooks logout and the exit link, schedules the daily recovery_mode_clean_expired_keys event, and makes recovery mode active for WP_RECOVERY_MODE_SESSION_ID (or a valid cookie). Exiting needs an active session.
$mode = new WP_Recovery_Mode();
$before = array( $mode->is_initialized(), $mode->is_active(), $mode->exit_recovery_mode() );
define( 'WP_RECOVERY_MODE_SESSION_ID', 'guide-session' );
$mode->initialize();
return array( $before, $mode->is_initialized(), $mode->is_active(), $mode->get_session_id(), wp_get_schedule( 'recovery_mode_clean_expired_keys' ), has_action( 'wp_logout', array( $mode, 'exit_recovery_mode' ) ), has_action( 'login_form_exit_recovery_mode', array( $mode, 'handle_exit_recovery_mode' ) ) );
