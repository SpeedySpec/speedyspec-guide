<?php
// Saves a file uploaded in a form field as an attachment of a post, with its metadata; gives the attachment ID or an error.
return media_handle_upload( 'nothing', 0 )->get_error_message();
