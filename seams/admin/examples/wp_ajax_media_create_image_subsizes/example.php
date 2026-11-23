<?php
// Ajax handler that makes the image sub-sizes an upload didn't finish, after the server ran out of time or memory, and sends the attachment's data.
$sent = json_decode( guide_ajax( 'wp_ajax_media_create_image_subsizes', array( 'attachment_id' => 0 ), 'media-form' ), true );
return $sent['success'];
