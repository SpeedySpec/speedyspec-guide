<?php
// Deletes auto-drafts older than a week; run daily by cron.
$old = wp_insert_post( array( 'post_title' => 'Auto', 'post_status' => 'auto-draft' ) );
global $wpdb;
$wpdb->update( $wpdb->posts, array( 'post_date' => '2020-01-01 00:00:00' ), array( 'ID' => $old ) );
wp_delete_auto_drafts();
return get_post( $old );
