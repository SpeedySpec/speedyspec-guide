<?php
// Whether an attachment is of a type (image, audio, video) or has an extension.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( wp_attachment_is( 'image', $att ), wp_attachment_is( 'video', $att ), wp_attachment_is( 'jpg', $att ) );
