<?php
// Ajax handler for the revisions screen: sends the differences between pairs of a post's revisions as JSON.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_content' => 'One', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $post, 'post_content' => 'Two' ) );
$revisions = array_keys( wp_get_post_revisions( $post ) );
$sent = json_decode( guide_ajax( 'wp_ajax_get_revision_diffs', array( 'post_id' => $post, 'compare' => array( $revisions[1] . ':' . $revisions[0] ) ) ), true );
return array( $sent['success'], count( $sent['data'] ) );
