<?php
// Whether an image editor can handle a MIME type and methods.
return array( wp_image_editor_supports( array( 'mime_type' => 'image/png' ) ), wp_image_editor_supports( array( 'mime_type' => 'image/x-nonesuch' ) ) );
