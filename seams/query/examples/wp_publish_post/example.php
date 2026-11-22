<?php
// Publishes a post directly, firing the transition and save hooks without wp_insert_post()'s checks.
$id = wp_insert_post( array( 'post_title' => 'Later', 'post_status' => 'future', 'post_date' => '2030-01-01 00:00:00' ) );
wp_publish_post( $id );
return array( get_post_status( $id ), did_action( 'publish_post' ) );
