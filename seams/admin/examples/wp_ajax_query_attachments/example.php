<?php
// Ajax handler for the media modal's library: queries attachments with the modal's arguments and sends their data as JSON; ajax_query_attachments_args filters the query.
wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg' ), '2026/11/lake.jpg' );
$sent = json_decode( guide_ajax( 'wp_ajax_query_attachments', array( 'query' => array( 'posts_per_page' => 10 ) ) ), true );
return array( $sent['success'], wp_list_pluck( $sent['data'], 'title' ) );
