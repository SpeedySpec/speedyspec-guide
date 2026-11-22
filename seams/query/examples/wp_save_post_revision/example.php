<?php
// Saves a revision of a post when revisions are on and a revisioned field changed since the last one, then drops revisions beyond the number to keep; the new revision's ID, or nothing.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );

$first = wp_save_post_revision( $id );
$same = wp_save_post_revision( $id );
return array( get_post( $first )->post_title, $same );
