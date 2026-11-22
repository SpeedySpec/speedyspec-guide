<?php
// A post's edit screen URL, for users who can edit it; filtered by get_edit_post_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
$admin = get_edit_post_link( $id, 'raw' );
wp_set_current_user( 0 );
return array( $admin, get_edit_post_link( $id ) );
