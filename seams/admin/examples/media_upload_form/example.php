<?php
// Prints the old media dialog's upload form: the Plupload uploader, or the browser uploader when chosen.
return str_contains( guide_render( fn() => media_upload_form() ), 'plupload-upload-ui' );
