<?php
// Ajax handler for the Choose from the most used tags link: prints a tag cloud of a taxonomy's most used terms.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish', 'tags_input' => array( 'oolong', 'sencha' ) ) );
$sent = guide_ajax( 'wp_ajax_get_tagcloud', array( 'tax' => 'post_tag' ) );
return array( str_contains( $sent, 'oolong' ), str_contains( $sent, 'tag-cloud-link' ) );
