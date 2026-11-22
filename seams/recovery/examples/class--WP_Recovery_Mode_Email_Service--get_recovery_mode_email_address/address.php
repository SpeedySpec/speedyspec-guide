<?php
// The email goes to RECOVERY_MODE_EMAIL when it is a valid address, else to the admin_email option.
$service = new WP_Recovery_Mode_Email_Service( new WP_Recovery_Mode_Link_Service( new WP_Recovery_Mode_Cookie_Service(), new WP_Recovery_Mode_Key_Service() ) );
$admin = guide_call( $service, 'get_recovery_mode_email_address' );
define( 'RECOVERY_MODE_EMAIL', 'ops@example.org' );
return array( $admin, guide_call( $service, 'get_recovery_mode_email_address' ) );
