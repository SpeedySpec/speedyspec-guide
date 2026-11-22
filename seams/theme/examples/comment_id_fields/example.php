<?php
// Prints the comment form's hidden ID fields.
$id = wp_insert_post( array( 'post_title' => 'Talk', 'post_status' => 'publish' ) );
return guide_render( fn() => comment_id_fields( $id ) );
