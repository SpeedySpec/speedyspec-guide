<?php
// Prints the old media dialog's From Computer tab: the upload form and the uploaded items.
$GLOBALS['post_ID'] = 0;
return str_contains( guide_render( fn() => media_upload_type_form( 'image' ) ), 'media-upload-form' );
