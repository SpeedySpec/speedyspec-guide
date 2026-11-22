<?php
// A post's newest revision ID and its number of revisions, or an error when revisions are off.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v3' ) );

$data = wp_get_latest_revision_id_and_total_count( $id );
return array( get_post( $data['latest_id'] )->post_title, $data['count'] );
