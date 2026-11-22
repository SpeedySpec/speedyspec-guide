<?php
// A post's revisions as data for the revisions screen's script: authors, dates, whether each can be restored, and the selected pair.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_content' => 'One', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $post, 'post_content' => 'Two' ) );
$data = wp_prepare_revisions_for_js( get_post( $post ), 0 );
return array( count( $data['revisionData'] ), $data['postId'] === $post );
