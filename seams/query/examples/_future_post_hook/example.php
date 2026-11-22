<?php
// Hooked to future_post: schedules the publish_future_post cron event for the post's time.
$id = wp_insert_post( array( 'post_title' => 'Later', 'post_status' => 'future', 'post_date' => '2030-01-01 00:00:00' ) );
return gmdate( 'Y-m-d', wp_next_scheduled( 'publish_future_post', array( $id ) ) );
