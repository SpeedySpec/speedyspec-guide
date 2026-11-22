<?php
// When an event is due and no other run holds the lock, sets the doing_cron transient and posts a non-blocking request to wp-cron.php; cron_request filters it. Nothing due, or a lock under WP_CRON_LOCK_TIMEOUT old, sends nothing.
add_filter( 'pre_http_request', function ( $pre, $args, $url ) { echo "request $url, blocking: ", var_export( $args['blocking'], true ), "\n"; return array( 'response' => array( 'code' => 200 ) ); }, 10, 3 );
add_filter( 'cron_request', function ( $request ) { $request['args']['headers'] = array( 'X-Guide' => '1' ); return $request; } );
$nothing_due = spawn_cron( 1500000000.5 );
wp_schedule_single_event( 1000000000, 'guide_due' );
$spawned = spawn_cron( 1500000000.5 );
return array( $nothing_due, $spawned, get_transient( 'doing_cron' ), spawn_cron( 1500000030.5 ) );
