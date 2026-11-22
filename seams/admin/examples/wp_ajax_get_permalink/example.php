<?php
// Ajax handler that sends a post's permalink, for the editor.
$post = wp_insert_post( array( 'post_title' => 'Oolong notes', 'post_status' => 'publish' ) );
return guide_ajax( 'wp_ajax_get_permalink', array( 'post_id' => $post, 'getpermalinknonce' => wp_create_nonce( 'getpermalink' ) ) ) === get_preview_post_link( $post );
