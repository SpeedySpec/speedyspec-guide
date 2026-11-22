<?php
// The URL of an attachment's image at a size, or false.
$id = guide_attachment();
return array( wp_get_attachment_image_url( $id, 'medium' ), wp_get_attachment_image_url( $id, 'full' ) );
