<?php
// Runs the queued pings: pingbacks, enclosures and trackbacks of posts flagged for them, and the update services; hooked to the do_pings cron event.
do_all_pings();
return array( has_action( 'do_all_pings', 'do_all_pingbacks' ), has_action( 'do_all_pings', 'do_all_enclosures' ), has_action( 'do_all_pings', 'do_all_trackbacks' ), has_action( 'do_all_pings', 'generic_ping' ) );
