<?php
// The doing_cron lock value read straight from the database (or the persistent object cache), bypassing caches, so a run sees another's lock; 0 without one.
guide_load_functions( 'wp-cron.php', '_get_cron_lock' );
$none = _get_cron_lock();
set_transient( 'doing_cron', '1500000000.5' );
return array( $none, _get_cron_lock() );
