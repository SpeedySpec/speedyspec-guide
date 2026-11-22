<?php
// Records enclosures for every post flagged with _encloseme, removing the flag.
$post = wp_insert_post( array( 'post_title' => 'Enc', 'post_status' => 'publish' ) );
add_post_meta( $post, '_encloseme', '1' );
do_all_enclosures();
return get_post_meta( $post, '_encloseme' );
