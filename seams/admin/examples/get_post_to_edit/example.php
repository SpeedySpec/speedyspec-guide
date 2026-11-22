<?php
// Deprecated in 3.5.0; use get_post(). Gave a post with its fields prepared for the editor.
wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
list( $result, $notice ) = guide_deprecated( 'get_post_to_edit', 1 );
return array( $result->post_title, $result->post_status, $notice );
