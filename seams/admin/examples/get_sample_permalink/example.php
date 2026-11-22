<?php
// A post's permalink pattern with %postname% and its slug, for the permalink editor, as if it were published.
$GLOBALS['wp_rewrite']->set_permalink_structure( '/%postname%/' );
$post = wp_insert_post( array( 'post_title' => 'Green tea', 'post_status' => 'draft' ) );
return get_sample_permalink( $post );
