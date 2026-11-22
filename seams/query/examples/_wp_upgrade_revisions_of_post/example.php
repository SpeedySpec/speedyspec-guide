<?php
// Upgrades a post's revisions from before version 1 (WordPress 3.6) by renaming them, under a lock; true when done.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$old = _wp_put_post_revision( array( 'ID' => $id, 'post_title' => 'old' ) );
wp_update_post( array( 'ID' => $old, 'post_name' => "$id-revision" ) );
$result = _wp_upgrade_revisions_of_post( get_post( $id ), array( get_post( $old ) ) );
return array( $result, get_post( $old )->post_name === "$id-revision-v1" );
