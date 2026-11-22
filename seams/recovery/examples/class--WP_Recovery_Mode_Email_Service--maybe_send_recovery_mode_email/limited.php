<?php
// One email per rate limit: when the recovery_mode_email_last_sent option is within it, nothing is sent and the error says how long ago and how long to wait; clear_rate_limit() deletes the option.
update_option( 'recovery_mode_email_last_sent', time() - HOUR_IN_SECONDS );
$service = new WP_Recovery_Mode_Email_Service( new WP_Recovery_Mode_Link_Service( new WP_Recovery_Mode_Cookie_Service(), new WP_Recovery_Mode_Key_Service() ) );
$error = $service->maybe_send_recovery_mode_email( DAY_IN_SECONDS, array(), array( 'type' => 'plugin', 'slug' => 'broken' ) );
return array( $error->get_error_code(), $error->get_error_message(), $service->clear_rate_limit(), get_option( 'recovery_mode_email_last_sent' ), $service->clear_rate_limit() );
