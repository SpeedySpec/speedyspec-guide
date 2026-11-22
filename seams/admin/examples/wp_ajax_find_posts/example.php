<?php
// Ajax handler for the Find Posts or Pages dialog: sends a table of posts matching the search, to attach media to.
wp_insert_post( array( 'post_title' => 'Oolong notes', 'post_status' => 'publish' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_find_posts', array( 'ps' => 'Oolong' ), 'find-posts' ), true );
return array( $sent['success'], str_contains( $sent['data'], 'Oolong notes' ) );
