<?php
// Scales a width and height to fit an image size and, in the editor, the content width; filtered by editor_max_image_size.
$GLOBALS['content_width'] = 640;
return array( image_constrain_size_for_editor( 1200, 800, 'medium' ), image_constrain_size_for_editor( 1200, 800, 'large', 'edit' ) );
