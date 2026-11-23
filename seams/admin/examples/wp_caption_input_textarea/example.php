<?php
// The caption textarea of the old media dialog.
$id = wp_insert_attachment( array( 'post_title' => 'Lake', 'post_mime_type' => 'image/jpeg', 'post_excerpt' => 'A calm lake' ), '2026/11/lake.jpg' );
return wp_caption_input_textarea( get_post( $id ) );
