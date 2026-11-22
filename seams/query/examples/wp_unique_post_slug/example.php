<?php
// A post slug made unique among its type (and parent for hierarchical types) by adding -2, -3 and so on, avoiding reserved feed and archive slugs; filtered by wp_unique_post_slug.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array( wp_unique_post_slug( 'hello', 0, 'publish', 'post', 0 ), wp_unique_post_slug( 'hello', $id, 'publish', 'post', 0 ), wp_unique_post_slug( 'feed', 0, 'publish', 'post', 0 ), wp_unique_post_slug( 'hello', 0, 'draft', 'post', 0 ) );
