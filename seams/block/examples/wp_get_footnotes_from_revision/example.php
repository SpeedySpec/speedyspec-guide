<?php
// Hooked to _wp_post_revision_field_footnotes: a revision's footnotes for the revisions screen.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
$revision = get_post( _wp_put_post_revision( $id ) );
add_metadata( 'post', $revision->ID, 'footnotes', '[{"id":"1","content":"A note"}]' );
return wp_get_footnotes_from_revision( '', 'footnotes', $revision );
