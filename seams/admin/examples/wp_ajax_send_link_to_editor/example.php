<?php
// Ajax handler for inserting a URL from the media modal: sends an embed shortcode or a link to put in the classic editor.
$sent = json_decode( guide_ajax( 'wp_ajax_send_link_to_editor', array( 'src' => 'https://example.org/notes.pdf', 'link_text' => 'Notes', 'nonce' => wp_create_nonce( 'media-send-to-editor' ) ) ), true );
return array( $sent['success'], $sent['data'] );
