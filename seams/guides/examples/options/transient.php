<?php
// A transient is a cached value with an expiry: store an expensive answer, and read it back until it expires.
function guide_expensive_count() {
	echo 'counting... ';
	return 42;
}
foreach ( array( 1, 2 ) as $read ) {
	$count = get_transient( 'guide_count' );
	if ( false === $count ) {
		$count = guide_expensive_count();
		set_transient( 'guide_count', $count, HOUR_IN_SECONDS );
	}
	echo esc_html( "read $read: $count " );
}
return null;
