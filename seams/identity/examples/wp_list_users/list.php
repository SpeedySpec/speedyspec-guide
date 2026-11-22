<?php
// Prints (or returns with echo false) the users' names as a list or comma-separated, optionally full names and feed links; exclude_admin leaves out a user whose display name is 'admin'. Unlike wp_list_authors(), names aren't linked.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
return wp_list_users( array( 'echo' => false, 'exclude_admin' => false, 'show_fullname' => false ) );
