<?php
// Ajax handler for the link dialog's search: sends the posts matching the typed text, with their titles, links and dates, as JSON.
wp_insert_post( array( 'post_title' => 'Oolong notes', 'post_status' => 'publish' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_wp_link_ajax', array( 'search' => 'Oolong', '_ajax_linking_nonce' => wp_create_nonce( 'internal-linking' ) ) ), true );
return array( $sent[0]['title'], $sent[0]['permalink'] );
