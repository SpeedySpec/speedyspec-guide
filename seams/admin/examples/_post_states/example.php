<?php
// Prints a post's states after its title in admin lists, separated by commas.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
return guide_render( fn() => _post_states( get_post( $post ) ) );
