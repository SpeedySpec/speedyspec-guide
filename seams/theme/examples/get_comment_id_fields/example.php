<?php
// The comment form's hidden post and parent ID fields; filtered by comment_id_fields.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
return get_comment_id_fields( $id );
