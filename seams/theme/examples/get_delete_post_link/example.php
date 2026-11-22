<?php
// A post's trash (or delete) URL with its nonce, for users who can delete it; filtered by get_delete_post_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
return str_contains( get_delete_post_link( $id ), 'action=trash' ) && str_contains( get_delete_post_link( $id, '', true ), 'action=delete' );
