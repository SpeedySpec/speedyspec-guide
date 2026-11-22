<?php
// The MIME types image editors save each input type as: HEIC and HEIF become JPEG; filtered by image_editor_output_format.
return wp_get_image_editor_output_format( 'photo.heic', 'image/heic' );
