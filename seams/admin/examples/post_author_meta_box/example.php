<?php
// Prints the Author box: a select of the users who may author the post.
$post = get_post( wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) ) );
return str_contains( guide_render( fn() => post_author_meta_box( $post ) ), "name='post_author_override'" );
