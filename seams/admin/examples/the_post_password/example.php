<?php
// Prints the password of the current post, escaped, for the edit screen.
$GLOBALS['post'] = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_password' => 's3cret', 'post_status' => 'publish' ) ) );
return guide_render( 'the_post_password' );
