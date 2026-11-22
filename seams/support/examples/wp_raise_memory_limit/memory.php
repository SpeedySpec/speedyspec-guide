<?php
// Raises PHP's memory limit for a context (admin, image or cron) to WP_MAX_MEMORY_LIMIT, or to the limit {context}_memory_limit gives when that is higher; never lowers it. Gives the new limit, or false.
ini_set( 'memory_limit', '64M' );
$admin = wp_raise_memory_limit( 'admin' );
function guide_image_memory_limit( $limit ) {
	return '512M';
}
add_filter( 'image_memory_limit', 'guide_image_memory_limit' );
return array( $admin, wp_raise_memory_limit( 'image' ), ini_get( 'memory_limit' ) );
