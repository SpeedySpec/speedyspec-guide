<?php
// Marks the uploader settings to show an error for HEIC uploads when no image editor can convert them.
return array_key_exists( 'heic_upload_error', wp_show_heic_upload_error( array() ) ) === ! wp_image_editor_supports( array( 'mime_type' => 'image/heic' ) );
