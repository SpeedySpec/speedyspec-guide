<?php
// The scheduled cleanup removes keys older than the link's time to live.
update_option( 'recovery_keys', array( 'old' => array( 'hashed_key' => 'x', 'created_at' => time() - 2 * DAY_IN_SECONDS ), 'new' => array( 'hashed_key' => 'y', 'created_at' => time() ) ) );
( new WP_Recovery_Mode() )->clean_expired_keys();
return array_keys( get_option( 'recovery_keys' ) );
