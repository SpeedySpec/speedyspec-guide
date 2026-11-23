<?php
// Prints the old uploader's checkbox to scale images down to the large size before uploading.
return str_contains( guide_render( 'media_upload_max_image_resize' ), 'image_resize' );
