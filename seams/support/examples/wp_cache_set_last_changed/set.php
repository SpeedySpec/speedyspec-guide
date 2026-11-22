<?php
// Marks a cache group as changed now, firing wp_cache_set_last_changed with the old time.
function guide_print_changed_group( $group ) {
	echo "$group changed\n";
}
add_action( 'wp_cache_set_last_changed', 'guide_print_changed_group' );
$old = wp_cache_get_last_changed( 'guide' );
return wp_cache_set_last_changed( 'guide' ) !== $old;
