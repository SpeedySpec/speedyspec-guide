<?php
// A post's tags as a comma-separated string for the tag box.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish', 'tags_input' => array( 'oolong', 'smoky' ) ) );
return get_tags_to_edit( $post );
