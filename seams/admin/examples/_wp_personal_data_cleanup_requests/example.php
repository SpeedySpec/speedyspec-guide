<?php
// Marks privacy requests that weren't confirmed within the expiry time as failed.
$request = wp_create_user_request( 'ada@example.org', 'export_personal_data' );
global $wpdb;
$wpdb->update( $wpdb->posts, array( 'post_modified_gmt' => '2000-01-01 00:00:00', 'post_modified' => '2000-01-01 00:00:00' ), array( 'ID' => $request ) );
clean_post_cache( $request );
_wp_personal_data_cleanup_requests();
return get_post_status( $request );
