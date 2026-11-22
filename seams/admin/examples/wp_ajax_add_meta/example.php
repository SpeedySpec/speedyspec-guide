<?php
// Ajax handler for the Custom Fields box: adds or updates a post's custom field and sends back its table row as XML.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$sent = guide_ajax( 'wp_ajax_add_meta', array( 'post_id' => $post, 'metakeyinput' => 'origin', 'metavalue' => 'Fujian', '_ajax_nonce-add-meta' => wp_create_nonce( 'add-meta' ) ) );
return array( str_contains( $sent, '<wp_ajax>' ), get_post_meta( $post, 'origin', true ) );
