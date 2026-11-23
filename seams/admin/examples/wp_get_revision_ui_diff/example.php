<?php
// The differences between two revisions of a post, field by field (title, content, excerpt), as rendered diffs for the revisions screen.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_content' => 'One', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $post, 'post_content' => 'Two' ) );
$revisions = array_keys( wp_get_post_revisions( $post ) );
$diff = wp_get_revision_ui_diff( $post, $revisions[1], $revisions[0] );
return wp_list_pluck( $diff, 'id' );
