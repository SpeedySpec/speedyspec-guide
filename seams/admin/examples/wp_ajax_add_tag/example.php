<?php
// Ajax handler for the Add New Tag form: inserts the term and sends back the new list table row as XML.
$sent = guide_ajax( 'wp_ajax_add_tag', array( 'taxonomy' => 'post_tag', 'tag-name' => 'oolong', 'screen' => 'edit-post_tag', '_wpnonce_add-tag' => wp_create_nonce( 'add-tag' ) ) );
return array( str_contains( $sent, '<wp_ajax>' ), term_exists( 'oolong', 'post_tag' ) !== null );
