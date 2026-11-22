<?php
// Rewrites the old cron format, without argument keys, keying each event by an md5 of its arguments, and saves it.
$old = array( 1500000000 => array( 'guide_send' => array( 'schedule' => false, 'args' => array( 3 ) ) ) );
$new = _upgrade_cron_array( $old );
return array( $new, get_option( 'cron' ) === $new, _upgrade_cron_array( array( 'version' => 2 ) ) );
