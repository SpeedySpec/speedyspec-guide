<?php
// Removes the records older than the time to live, and any without a creation time.
update_option( 'recovery_keys', array( 'old' => array( 'hashed_key' => 'x', 'created_at' => 1000000000 ), 'broken' => array(), 'new' => array( 'hashed_key' => 'y', 'created_at' => time() ) ) );
( new WP_Recovery_Mode_Key_Service() )->clean_expired_keys( DAY_IN_SECONDS );
return array_keys( get_option( 'recovery_keys' ) );
