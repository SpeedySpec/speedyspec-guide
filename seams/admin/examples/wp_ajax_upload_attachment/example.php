<?php
// Ajax handler for the media modal's uploads: saves the uploaded file as an attachment and sends its data as JSON.
$sent = json_decode( guide_ajax( 'wp_ajax_upload_attachment', array(), 'media-form' ), true );
return $sent['success'];
