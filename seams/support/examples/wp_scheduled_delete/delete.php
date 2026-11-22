<?php
// Empties the trash: posts and comments trashed longer than EMPTY_TRASH_DAYS ago are deleted; trash meta left on items no longer trashed is removed.
$old = wp_insert_post( array( 'post_title' => 'Old', 'post_status' => 'publish' ) );
$new = wp_insert_post( array( 'post_title' => 'New', 'post_status' => 'publish' ) );
wp_trash_post( $old );
wp_trash_post( $new );
update_post_meta( $old, '_wp_trash_meta_time', time() - 31 * DAY_IN_SECONDS );
wp_scheduled_delete();
return array( get_post( $old ), get_post_status( $new ) );
