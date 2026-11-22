<?php
// Without a persistent object cache, a transient is stored as an option, plus a timeout option when it expires.
set_transient( 'guide_minute', 'v', MINUTE_IN_SECONDS );
global $wpdb;
return $wpdb->get_col(
	$wpdb->prepare(
		"SELECT option_name FROM $wpdb->options WHERE option_name LIKE %s ORDER BY option_name",
		'%' . $wpdb->esc_like( 'guide_minute' )
	)
);
