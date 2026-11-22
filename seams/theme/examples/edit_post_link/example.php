<?php
// Prints a link to edit the current post, for users who can; filtered by edit_post_link.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_name' => 'hello-world', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:00:00' ) );
return guide_render( fn() => edit_post_link( 'Edit', '<span>', '</span>', $id ) );
