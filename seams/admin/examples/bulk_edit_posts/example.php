<?php
// Applies the Bulk Edit form to several posts: author, status, terms, comments and more; gives the updated, skipped and locked IDs.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'draft' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'draft' ) );
$result = bulk_edit_posts( array( 'post' => array( $a, $b ), 'post_type' => 'post', '_status' => 'pending' ) );
return array( count( $result['updated'] ), get_post_status( $a ), get_post_status( $b ) );
