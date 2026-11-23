<?php
// Ajax handler for the classic editor's permalink: sends the permalink editor HTML for a post with a new slug or title.
$post = wp_insert_post( array( 'post_title' => 'Oolong notes', 'post_status' => 'publish' ) );
$sent = guide_ajax( 'wp_ajax_sample_permalink', array( 'post_id' => $post, 'new_slug' => 'oolong', 'samplepermalinknonce' => wp_create_nonce( 'samplepermalink' ) ) );
return str_contains( $sent, 'id="sample-permalink"' );
