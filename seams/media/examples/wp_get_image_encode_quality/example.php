<?php
// The quality image editors encode a MIME type at: 86 for WebP and 82 for others, through wp_editor_set_quality and, for JPEG, jpeg_quality.
return array( wp_get_image_encode_quality( 'image/jpeg' ), wp_get_image_encode_quality( 'image/webp' ), wp_get_image_encode_quality( 'image/png', array(), 75 ) );
