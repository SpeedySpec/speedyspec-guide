<?php
// Publishes a scheduled post when its time has come, or reschedules its cron event when it hasn't.
$id = wp_insert_post( array( 'post_title' => 'Due', 'post_status' => 'future', 'post_date' => '2030-01-01 00:00:00' ) );
global $wpdb;
$wpdb->update( $wpdb->posts, array( 'post_date_gmt' => '2020-01-01 00:00:00', 'post_date' => '2020-01-01 00:00:00' ), array( 'ID' => $id ) );
clean_post_cache( $id );
check_and_publish_future_post( $id );
return get_post_status( $id );
