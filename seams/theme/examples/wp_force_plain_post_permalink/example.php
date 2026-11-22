<?php
// Whether a post's permalink must stay plain: drafts, scheduled and pending posts, and posts whose parent can't have pretty links; filtered by wp_force_plain_post_permalink.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$draft = wp_insert_post( array( 'post_title' => 'Draft' ) );
return array( wp_force_plain_post_permalink( $id ), wp_force_plain_post_permalink( $draft ) );
