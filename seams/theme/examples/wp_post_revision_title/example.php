<?php
// A revision's date and time as its title, linked to it, marked as an autosave when it is one.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2' ) );
$rev = current( wp_get_post_revisions( $id ) );
$title = wp_post_revision_title( $rev, false );
return array( str_contains( $title, ' @ ' ), str_contains( wp_post_revision_title( $rev ), '<a href=' ) );
