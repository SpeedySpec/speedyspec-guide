<?php
// Prints the old media dialog's Media Library tab: the filters and a page of attachments.
return str_contains( guide_render( fn() => media_upload_library_form( null ) ), 'filter' );
