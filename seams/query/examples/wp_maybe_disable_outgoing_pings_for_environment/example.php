<?php
// Hooked to do_all_pings first: outside production, removes the pingback, trackback and update service callbacks, keeping enclosures.
add_filter( 'wp_should_disable_pings_for_environment', '__return_true' );
wp_maybe_disable_outgoing_pings_for_environment();
return array( has_action( 'do_all_pings', 'do_all_pingbacks' ), has_action( 'do_all_pings', 'do_all_enclosures' ) );
