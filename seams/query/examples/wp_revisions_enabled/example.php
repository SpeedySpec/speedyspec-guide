<?php
// Whether a post's type supports revisions and revisions are kept.
$post = get_post( wp_insert_post( array( 'post_title' => 'x' ) ) );
add_filter( 'wp_revisions_to_keep', '__return_zero' );
return array( post_type_supports( 'post', 'revisions' ), wp_revisions_enabled( $post ) );
