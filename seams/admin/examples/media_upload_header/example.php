<?php
// Prints the header of the old media dialog: its tabs.
$GLOBALS['tab'] = 'type';
return str_contains( guide_render( 'media_upload_header' ), 'media-upload-header' );
