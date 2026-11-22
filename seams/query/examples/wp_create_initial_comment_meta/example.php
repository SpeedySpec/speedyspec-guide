<?php
// Registers the comment meta notes use, _wp_note_status (resolved or reopen), shown in REST and editable by users who can edit the comment.
wp_create_initial_comment_meta();
$keys = get_registered_meta_keys( 'comment' );
return array( isset( $keys['_wp_note_status'] ), $keys['_wp_note_status']['show_in_rest']['schema']['enum'] ?? null );
