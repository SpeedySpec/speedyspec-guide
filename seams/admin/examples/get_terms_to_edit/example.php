<?php
// A post's terms in a taxonomy as a comma-separated string, escaped for a form; filtered by terms_to_edit.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish', 'tags_input' => array( 'oolong', 'tea, black' ) ) );
return get_terms_to_edit( $post );
