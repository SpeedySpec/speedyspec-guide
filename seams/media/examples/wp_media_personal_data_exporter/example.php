<?php
// Exports the URLs of the media a user attached to their posts, for a personal data export, a page of 50 at a time.
$user = wp_insert_user( array( 'user_login' => 'ada', 'user_email' => 'ada@example.org', 'user_pass' => wp_generate_password() ) );
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish', 'post_author' => $user ) );
guide_attachment( array( 'post_parent' => $post, 'post_author' => $user ) );
$export = wp_media_personal_data_exporter( 'ada@example.org' );
return array( count( $export['data'] ), $export['data'][0]['group_id'], $export['done'] );
