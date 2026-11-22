<?php
// A post's canonical URL, with its comment page; false for unpublished posts; filtered by get_canonical_url.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$draft = wp_insert_post( array( 'post_title' => 'D' ) );
return array( wp_get_canonical_url( $id ), wp_get_canonical_url( $draft ) );
