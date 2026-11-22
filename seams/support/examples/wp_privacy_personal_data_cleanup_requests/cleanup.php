<?php
// Marks personal data requests left pending longer than their key's expiry (a day, by user_request_key_expiration) as failed.
$id = wp_create_user_request( 'admin@example.org', 'export_personal_data' );
global $wpdb;
$wpdb->update( $wpdb->posts, array( 'post_modified' => gmdate( 'Y-m-d H:i:s', time() - 2 * DAY_IN_SECONDS ), 'post_modified_gmt' => gmdate( 'Y-m-d H:i:s', time() - 2 * DAY_IN_SECONDS ) ), array( 'ID' => $id ) );
clean_post_cache( $id );
wp_privacy_personal_data_cleanup_requests();
return get_post_status( $id );
